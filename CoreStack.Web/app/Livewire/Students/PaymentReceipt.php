<?php

namespace App\Livewire\Students;

use App\Models\Fee;
use App\Models\Payment;
use App\Service\FeeReceiptService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class PaymentReceipt extends Component
{
    public $paymentId;
    public $transactionId;
    public $session;
    public $amount;
    public $breakdown = [];
    public $totalFee;
    public $payment;
    public $QrCodeUrl;


    // Get all the query parameters from the Url coming from Fee-Slip-Breakdown page
    public function mount(FeeReceiptService $feeReceiptService)
    {
        $this->paymentId = request()->query('payment_id');
        $this->transactionId = request()->query('transaction_id');
        $this->session = request()->query('session');
        $this->amount = request()->query('amount');
        $this->totalFee = $this->amount;

        // Build or load payment and its breakdown
        $this->createPayment($feeReceiptService);
    }

    // Helper Function that is use on Mount
    public function createPayment(FeeReceiptService $feeReceiptService)
    {
        // Require essential query params to proceed
        if (! $this->paymentId || ! $this->transactionId || ! $this->amount) {
            return;
        }

        // If payment exists, reuse it and compute breakdown
        $existingPayment = Payment::where('paypal_payment_id', $this->paymentId)->first();

        if ($existingPayment) {
            $this->payment = $existingPayment;
            $result = $feeReceiptService->generateFeeSlipBreakdown($existingPayment);
            $this->breakdown = $result['breakdown'];
            $this->totalFee = $result['total_payment'];
            // Assign from result array (or fallback to model/URL)    
            $this->QrCodeUrl = $result['fee_remitter_url'] ?? $existingPayment->fee_remitter_url ?? url()->current();
            return;
        }

        // Otherwise create a new Payment record for the student
        $studentProfile = Auth::user()->StudentProfile;
        $fee = Fee::where('department_id', $studentProfile->department_id)
            ->where('level', $studentProfile->level)
            ->where('status', 'active')
            ->first();

        $this->payment = Payment::create([
            'user_id' => $studentProfile->user_id,
            'fee_id' => $fee->id,
            'reference_no' => 'REF'.random_int(1000000, 9999999),
            'paypal_payment_id' => $this->paymentId,
            'paypal_transection_id' => $this->transactionId,
            'amount_paid' => $this->amount,
            'session' => $this->session,
            'semester' => 'First',
            'status' => 'completed',
            'fee_remitter_url' => null,
            'fee_breakdown_url' => null,
        ]);

        // Compute and attach breakdown using the service
        $result = $feeReceiptService->generateFeeSlipBreakdown($this->payment);
        
        
        $this->breakdown = $result['breakdown'];
        $this->totalFee = $result['total_payment'];
        // Assign from result array (or fallback to model/URL)
        $this->QrCodeUrl  = $result["fee_remitter_url"] ?? url()->current();

    }


    // Function to handle Download Remitter payment from superbase
    public function DownloadRemiter()
    {

       try {
                // 1. Fetch payment by primary key ID
                $payment = Payment::where("paypal_transection_id", $this->transactionId)->first();

                if (!$payment) {
                    session()->flash('remitterError', 'Payment not found.');
                    return;
                }

                // 2. Define the path in your S3/Supabase storage
                $storagePath = "student_fee/fee_remitter/remitter_{$payment->id}.pdf";

                // 3. Verify the file exists on the S3 disk before downloading
                if (!Storage::disk('s3')->exists($storagePath)) {
                    session()->flash('remitterError', 'Receipt file not found on storage.');
                    return;
                }


                // 4. Trigger direct browser download
                return Storage::disk('s3')->download(
                    $storagePath, 
                    "Remitter_Receipt_{$payment->reference_no}.pdf" // just a name that was atteached to the pdf
                );
       } catch (\Throwable $th) {
          session()->flash('remitterError', 'Something went wrong! pls check your internet connection.');
       }
    }

    // Function to handle Download Breakdown payment from superbase
    public function DownloadBreakdown(){

       try {
                // 1. Fetch payment by primary key ID
                $payment = Payment::where("paypal_transection_id", $this->transactionId)->first();

                if (!$payment) {
                    session()->flash('breakdownError', 'Payment not found.');
                    return;
                }

                // 2. Define the path in your S3/Supabase storage
                $storagePath = "student_fee/fee_breakdown/slip_{$payment->id}.pdf";

                // 3. Verify the file exists on the S3 disk before downloading
                if (!Storage::disk('s3')->exists($storagePath)) {
                    session()->flash('breakdownError', 'Receipt file not found on storage.');
                    return;
                }


                // 4. Trigger direct browser download
                return Storage::disk('s3')->download(
                    $storagePath, 
                    "Breakdown_Receipt_{$payment->reference_no}.pdf" // just a name that was atteached to the pdf
                );
       } catch (\Throwable $th) {
          session()->flash('breakdownError', 'Something went wrong! pls check your internet connection.');
       } 
    }



    public function render()
    {
        // Sum computed breakdown for display
        $totalPayment = collect($this->breakdown)->sum('amount');

        return view('livewire.students.payment-receipt', [
            'paymentId' => $this->paymentId,
            'transactionId' => $this->transactionId,
            'session' => $this->session,
            'breakdown' => $this->breakdown,
            'totalPayment' => $totalPayment,
            "QrCodeUrl" => $this->QrCodeUrl,
        ])->layout('layouts.students.app');
    }
}

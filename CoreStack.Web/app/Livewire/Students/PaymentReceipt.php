<?php

namespace App\Livewire\Students;

use App\Models\Fee;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class PaymentReceipt extends Component
{
    public $paymentId;
    public $transactionId;
    public $session;
    public $amount;

    // This will hold the dynamic total fee from your database
    public $totalFee; 

    //  Get all the query parameters from the Url coming from Fee-Slip-Breakdown page
    public function mount()
    {
        $this->paymentId = request()->query('payment_id');
        $this->transactionId = request()->query('transaction_id');
        $this->session = request()->query('session');
        $this->amount = request()->query('amount');

      //  pass in the incoming $Amount to $totalFee that is used in the calculation below => getBreakdownProperty()
      $this->totalFee  =  $this->amount;  
    }

    
    //Note:   $this->breakdown  is not defiend anywhere but laravel understand 

    // The original static fee breakdown items
    private $feeStructure = [
        ['id' => 1, 'name' => 'Tuition Charges', 'baseAmount' => 45000.00],
        ['id' => 2, 'name' => 'Library Access Fee', 'baseAmount' => 3500.00],
        ['id' => 3, 'name' => 'ICT Infrastructure Fee', 'baseAmount' => 5000.00],
        ['id' => 4, 'name' => 'Medical Services', 'baseAmount' => 2500.00],
        ['id' => 5, 'name' => 'Sports & Games Levy', 'baseAmount' => 500.00],
        ['id' => 6, 'name' => 'Student ID Card Renewal', 'baseAmount' => 763.00],
        ['id' => 7, 'name' => 'Laboratory Logbook', 'baseAmount' => 1200.00],
        ['id' => 8, 'name' => 'Examination Processing', 'baseAmount' => 2000.00],
        ['id' => 9, 'name' => 'Campus Security Levy', 'baseAmount' => 1000.00],
        ['id' => 10, 'name' => 'Student Insurance Policy', 'baseAmount' => 1336.65],
    ];



    /**
     * Computes the breakdown dynamically based on the current total fee
     */
    public function getBreakdownProperty()
    {
        $calculatedBreakdown = [];
        $runningTotal = 0;
        $totalItems = count($this->feeStructure);

        // FIX 1: Calculate the true base total dynamically from the structure
        $baseTotal = collect($this->feeStructure)->sum('baseAmount'); 

        foreach ($this->feeStructure as $index => $item) {
            // Calculate proportional share
            $dynamicAmount = ($item['baseAmount'] / $baseTotal) * $this->totalFee;
            
            // Round to 2 decimal places
            $dynamicAmount = round($dynamicAmount, 2);
            $runningTotal += $dynamicAmount;

            // FIX 2: If it's the last item, absorb any rounding difference directly
            if ($index === $totalItems - 1) {
                $difference = $this->totalFee - $runningTotal;
                $dynamicAmount = round($dynamicAmount + $difference, 2);
            }

            $calculatedBreakdown[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'amount' => $dynamicAmount
            ];
        }

        return $calculatedBreakdown;
    }

    // this function is used to Insert the user details on payment table
    public function createPayment(){

         // 1. fetch only the record on StudentProfile table based on the login user 
        $studentProfile = Auth::user()->StudentProfile;

        // 2.  fetch the fee id 
        $fee = Fee::where("department_id", $studentProfile->department_id)->where("level", $studentProfile->level)->where("status", "active")->first();

        // 3. insert into payment table 
        Payment::create([
            "user_id" => $studentProfile->user_id,
            "fee_id" => $fee->id,
            "reference_no" => "REF". random_int(1000000, 9999999),
            "paypal_payment_id" => $this->paymentId,
            "paypal_transection_id" => $this->transactionId,
            "amount_paid" => $this->amount,
            "session" => $this->session,
            "semester" => "First",
            "status" => "completed",
            "fee_remitter_url" => null,
            "fee_breakdown_url" => null,
        ]);

    }


    public function render()
    {
        // call the method here 
        $this->createPayment();

        // This will now successfully dump exactly User school fees
        // dd(collect($this->breakdown)->sum("amount"));
        // dd($this->breakdown);

        $totalPayment =  collect($this->breakdown)->sum("amount");  // Sum the total school fees payment
        
        return view('livewire.students.payment-receipt', [
            'paymentId' => $this->paymentId,
            'transactionId' => $this->transactionId,
            'session' => $this->session,
            "breakdown" => $this->breakdown,
            "totalPayment" => $totalPayment,
        ])->layout("layouts.students.app");
    }
}

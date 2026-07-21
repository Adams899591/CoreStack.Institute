<?php
namespace App\Service;

use App\Models\Payment;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf; // Import the DomPDF Facade

class FeeReceiptService
{
    /**
     * Generate a fee slip breakdown, render the views, convert them to binary PDFs,
     * upload them to Supabase, and store the remote Supabase URLs on the Payment model.
     *
     * @param Payment $feePayment
     * @return array{
     *     payment: Payment,
     *     breakdown: array<array{id:int,name:string,amount:float}>,
     *     total_payment: float,
     * }
     */
    public function generateFeeSlipBreakdown(Payment $feePayment): array
    {
        // 1. Build the proportional breakdown from the paid amount
        $breakdown = $this->calculateBreakdown((float) $feePayment->amount_paid);

        // Total of the calculated breakdown amounts
        $totalPayment = array_sum(array_column($breakdown, 'amount'));

        // 2. Generate the binary PDF payloads instead of raw HTML strings
        $remitterPdfBytes  = $this->generateRemitterReceiptPdf($feePayment, $breakdown);
        $breakdownPdfBytes = $this->generateBreakdownPdf($feePayment, $breakdown);

        // 3. Upload the generated binary PDF data directly to Supabase via S3 disk (Notice the extension change to .pdf)
        $supabaseRemitterUrl  = $this->uploadToSupabase($remitterPdfBytes, "student_fee/fee_remitter/remitter_{$feePayment->id}.pdf");
        $supabaseBreakdownUrl = $this->uploadToSupabase($breakdownPdfBytes, "student_fee/fee_breakdown/slip_{$feePayment->id}.pdf");

        // 4. Update the Payment model with the persistent PDF URLs from Supabase
        $feePayment->update([
            'fee_remitter_url'  => $supabaseRemitterUrl,
            'fee_breakdown_url' => $supabaseBreakdownUrl,
        ]);

        return [
            'payment' => $feePayment,
            'breakdown' => $breakdown,
            'total_payment' => $totalPayment,
             // Return the fee remitter and fee breakdownn to the function so it can be accessable on the QRCodeUrl
            'fee_remitter_url'  => $supabaseRemitterUrl,
            'fee_breakdown_url' => $supabaseBreakdownUrl,
        ];
    }

    /**
     * Compiles the Blade view and converts it into a binary PDF string for the Remitter.
     */
    public function generateRemitterReceiptPdf(Payment $feePayment, array $breakdown): string
    {
        // 🔥 fetch the student profile, deparement, and user record 
       $studentProfile = StudentProfile::with(["Department","User"])->where('user_id', $feePayment->user_id)->first();

        return Pdf::loadView('pdf.payment-remitter-template', [
            'payment'   => $feePayment,
            'breakdown' => $breakdown,
            'studentProfile' => $studentProfile,         // Gives access to matric/reg no, department, level, etc.
        ])->output(); // ->output() extracts the raw binary PDF file content
    }

    /**
     * Compiles the Blade view and converts it into a binary PDF string for the Breakdown.
     */
    public function generateBreakdownPdf(Payment $feePayment, array $breakdown): string
    {
        return Pdf::loadView('pdf.payment-breakdown-template', [
            'payment'   => $feePayment,
            'breakdown' => $breakdown,
        ])->output();
    }

    /**
     * Handles uploading binary PDF contents to Supabase Storage bucket using S3 driver and returning the public URL.
     */
    protected function uploadToSupabase(string $pdfContent, string $storagePath): ?string
    {
        try {
            // We pass the raw binary string contents using put()
            $uploaded = Storage::disk('s3')->put($storagePath, $pdfContent, [
                'visibility' => 'public',
                'ContentType' => 'application/pdf' // Instructs the browser to view it as a native PDF file
            ]);

            if ($uploaded) {
                Log::info('Supabase PDF Upload Successful', ['generated_path' => $storagePath]);
                
                $mediaUrl = Storage::disk('s3')->url($storagePath);
                
                if (!$mediaUrl) {
                    Log::warning('Upload succeeded but Storage::url() returned empty string.');
                    return null;
                }
                
                return $mediaUrl;
            } else {
                Log::error('Supabase Upload Failed: Storage::put returned false.');
                return null;
            }
            
        } catch (\Throwable $th) {
            Log::error('Supabase S3 Exception: ' . $th->getMessage(), ['trace' => $th->getTraceAsString()]);
            return null;
        }
    }

    /**
     * Helper function that calculates the breakdown of a student's school fees.
     */
    protected function calculateBreakdown(float $totalFee): array
    {
        $feeStructure = [
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

        $baseTotal = array_sum(array_column($feeStructure, 'baseAmount'));
        $runningTotal = 0.0;
        $calculated = [];
        $totalItems = count($feeStructure);

        foreach ($feeStructure as $index => $item) {
            $amount = round(($item['baseAmount'] / $baseTotal) * $totalFee, 2);
            $runningTotal += $amount;

            if ($index === $totalItems - 1) {
                $difference = round($totalFee - $runningTotal, 2);
                $amount = round($amount + $difference, 2);
            }

            $calculated[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'amount' => $amount,
            ];
        }

        return $calculated;
    }
}
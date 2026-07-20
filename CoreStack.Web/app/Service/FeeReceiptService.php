<?php

namespace App\Service;

use App\Models\Payment;

class FeeReceiptService
{
    // Service that builds fee slip breakdowns and stores receipt URLs on a Payment
    /**
     * Generate a fee slip breakdown for a payment and store receipt URLs.
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
        // Build a proportional breakdown from the paid amount
        $breakdown = $this->calculateBreakdown((float) $feePayment->amount_paid);

        // Total of the calculated breakdown amounts
        $totalPayment = array_sum(array_column($breakdown, 'amount'));

        // Persist quick-access URLs for receipts (used by frontend links)
        $feePayment->update([
            'fee_remitter_url' => route('std.payment-receipt', [
                'payment_id' => $feePayment->id,
                'transaction_id' => $feePayment->paypal_transection_id,
                'session' => $feePayment->session,
                'amount' => $feePayment->amount_paid,
            ]),
            'fee_breakdown_url' => route('std.fee-slip-breakdown', [
                'feeAmount' => $feePayment->amount_paid,
                'session' => $feePayment->session,
            ]),
        ]);

        // Return payment and computed breakdown for caller to use
        return [
            'payment' => $feePayment,
            'breakdown' => $breakdown,
            'total_payment' => $totalPayment,
        ];
    }


    // Helper function that calculate the breakdown of a student school fees 
    protected function calculateBreakdown(float $totalFee): array
    {
        // Fixed fee items and their base amounts (used for proportional split)
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

        // Running totals and result container
        $runningTotal = 0.0;
        $calculated = [];
        $totalItems = count($feeStructure);

        // Split the paid amount proportionally across items
        foreach ($feeStructure as $index => $item) {
            // Each item's share (rounded to 2 decimals)
            $amount = round(($item['baseAmount'] / $baseTotal) * $totalFee, 2);
            $runningTotal += $amount;

            // Fix rounding remainder on the last item so totals match
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

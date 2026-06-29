<?php
namespace App\Livewire\Students;

use Livewire\Component;

class FeeSlipBreakdown extends Component
{
   // $feeAmount and $session are coming from the pass parameter from the Url
    public $feeAmount;  
    public $session;

    // This will hold the dynamic total fee from your database
    public $totalFee; 

   public function mount($feeAmount){
      $this->feeAmount = $feeAmount;
      $this->session = request()->query('session');


      //  pass in the incoming $feeAmount to $totalFee that is used in the calculation below => getBreakdownProperty()
      $this->totalFee  = $this->feeAmount;  
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
 
    public function render()
    {
        // This will now successfully dump exactly User school fees
        // dd(collect($this->breakdown)->sum("amount"));
        // dd($this->breakdown);

        $totalPayment =  collect($this->breakdown)->sum("amount");  // Sum the total school fees payment
        
        return view('livewire.students.fee-slip-breakdown', [
            'breakdown' => $this->breakdown,
            "totalPayment" => $totalPayment,
            "session" => $this->session,
        ])->layout("layouts.students.app");
    }
}
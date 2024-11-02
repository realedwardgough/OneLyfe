<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Calculator extends Controller
{
    
    //
    public function FullCalculation(Request $Request)
    {
        
        /*

            Average days per month: 30.44
            Average hours per month: 730.56
            Average hours sleep per month: 213.08

        */
        
        // Localise hours
        $hours_work_per_month = $Request -> input("hours_work_per_month");
        $hours_sleep_per_month = $Request -> input("hours_sleep_per_month");
        $hours_lesiure_per_month = $Request -> input("hours_lesiure_per_month");

        // Percentages
        $percentage_work = $this -> PercentageCalculator($hours_work_per_month, 730.56);
        $percentage_sleep = $this -> PercentageCalculator($hours_sleep_per_month, 730.56);
        $percentage_lesiure = $this -> PercentageCalculator($hours_lesiure_per_month, 730.56);
        $percentage_total_used = $percentage_work + $percentage_sleep + $percentage_lesiure;
        $percentage_remaining = 100 - $percentage_total_used;


        // Returned data in JSON format
        return response() -> json([
            'percentages' => [
                'work' => $percentage_work,
                'sleep' => $percentage_sleep,
                'lesiure' => $percentage_lesiure,
                'total' => $percentage_total_used,
                'remaining' => $percentage_remaining
            ],

            'original' => [
                'work' => $hours_work_per_month,
                'sleep' => $hours_sleep_per_month,
                'lesiure' => $hours_lesiure_per_month
            ]
        ]);

    }


    //
    private function PercentageCalculator(int $hours, int $from): int
    {
        return ($hours / $from) * 100;
    }

}

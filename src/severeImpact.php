<?php

require_once("impact.php");

Class SevereImpact extends Impact
{
    
    public function __construct($reportedCases, $periodType,$timeToElapse, $totalHospitalBeds,$population, $avgDailyIncomeInUSD,$avgDailyIncomePopulation){
      
        $this->currentlyInfected  =   $reportedCases * 50;
        $this->estimate( $periodType,$timeToElapse, $totalHospitalBeds,$population, $avgDailyIncomeInUSD,$avgDailyIncomePopulation);

    }

}
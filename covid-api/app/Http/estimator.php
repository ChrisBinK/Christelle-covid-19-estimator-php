<?php

require_once("impact.php");
require_once("severeImpact.php");

function covid19ImpactEstimator($data)
{
    
    $reportedCases = $data['reportedCases'];
    $periodType = $data['periodType'];
    $timeToElapse = $data['timeToElapse'];
    $totalHospitalBeds = $data['totalHospitalBeds'];
    $population = $data['population'];
    $avgDailyIncomeInUSD = $data['region']['avgDailyIncomeInUSD'];
    $avgDailyIncomePopulation =  $data['region']['avgDailyIncomePopulation'];
    
    $impact = new Impact($reportedCases, $periodType,$timeToElapse, $totalHospitalBeds,$population, $avgDailyIncomeInUSD,$avgDailyIncomePopulation );
    $severeImpact = new SevereImpact($reportedCases, $periodType,$timeToElapse, $totalHospitalBeds,$population, $avgDailyIncomeInUSD,$avgDailyIncomePopulation );

    $estimatorJson['data'] =  $data;
    $estimatorJson['impact'] =  $impact->getArray();
    $estimatorJson['severeImpact'] =  $severeImpact-> getArray();
  
    return  $estimatorJson ; //*/
 
}





 
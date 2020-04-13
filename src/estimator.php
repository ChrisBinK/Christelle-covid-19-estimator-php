<?php

require_once("impact.php");
require_once("severeImpact.php");

function covid19ImpactEstimator($data)
{
    // Convert to object
    $jsonArray = array();

    $reportedCases = $data['reportedCases'];
    $periodType = $data['periodType'];
    $timeToElapse = $data['timeToElapse'];
    $totalHospitalBeds = $data['totalHospitalBeds'];
    $population = $data['population'];
    $avgDailyIncomeInUSD = $data['region']->avgDailyIncomeInUSD;
    $avgDailyIncomePopulation =  $data['region']->avgDailyIncomePopulation;
    
    //$dataObject  = json_decode($reportedCases, $periodType,$timeToElapse, $totalHospitalBeds,$population, $avgDailyIncomeInUSD,$avgDailyIncomePopulation );
    $impact = new Impact($reportedCases, $periodType,$timeToElapse, $totalHospitalBeds,$population, $avgDailyIncomeInUSD,$avgDailyIncomePopulation );
    $severeImpact = new SevereImpact($reportedCases, $periodType,$timeToElapse, $totalHospitalBeds,$population, $avgDailyIncomeInUSD,$avgDailyIncomePopulation );

    $estimatorJson = [
      "data" =>$dataObject,
      "impact"=> $impact,
      "severeImpact"=>$severeImpact
    ];

    return  array_push($jsonArray, json_endcode($estimatorJson)); //*/
 
}


/*$data ='{
  region: {
  name: "Africa",
  avgAge: 19.7,
  avgDailyIncomeInUSD: 5,
  avgDailyIncomePopulation: 0.71
  },
  periodType: "days",
  timeToElapse: 58,
  reportedCases: 674,
  population: 66622705,
  totalHospitalBeds: 1380614
  }';
covid19ImpactEstimator($data);*/



 
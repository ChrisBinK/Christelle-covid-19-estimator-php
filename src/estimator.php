<?php

require_once("impact.php");
require_once("severeImpact.php");

function covid19ImpactEstimator($data)
{
  // Convert to object
  $jsonArray = array();
  

  
      $dataObject  = json_decode($data);
      $impact = new Impact($dataObject);
      $severeImpact = new SevereImpact($dataObject);
  
      $estimatorJson = [
        "data" =>$dataObject,
        "impact"=> $impact,
        "severeImpact"=>$severeImpact
      ];
      //array_push($jsonArray,json_encode($estimatorJson));
    
    
   
   

  
  return $jsonArray; //*/
 
}


$data ='{
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
covid19ImpactEstimator($data);



 
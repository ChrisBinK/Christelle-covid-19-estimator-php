<?php

require_once("impact.php");
require_once("severeImpact.php");

function covid19ImpactEstimator($data)
{
  // Convert to object
  $jsonArray = array();
  

  foreach($data  as $item){
    foreach($item  as $d){
      $dataObject  =  json_decode($d);
      $impact = new Impact($dataObject);
      $severeImpact = new SevereImpact($dataObject);
  
      $estimatorJson = [
        "data" =>$dataObject,
        "impact"=> $impact,
        "severeImpact"=>$severeImpact
      ];
      array_push($jsonArray,json_encode($estimatorJson));
    
    }
   
   
  }
  
  return $jsonArray; //*/
 
}



 
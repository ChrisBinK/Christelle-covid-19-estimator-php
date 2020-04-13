<?php

require_once("impact.php");
require_once("severeImpact.php");

function covid19ImpactEstimator($data)
{
  // Convert to object
  $jsonArray = array();
  

  foreach($data  as $item){
    
      $dataObject  =  json_decode($item[0]);
      $impact = new Impact($dataObject[0]);
      $severeImpact = new SevereImpact($dataObject[0]);
  
      $estimatorJson = [
        "data" =>$dataObject,
        "impact"=> $impact,
        "severeImpact"=>$severeImpact
      ];
      array_push($jsonArray,json_encode($estimatorJson));
    
    
   
   
  }
  
  return $jsonArray; //*/
 
}



 
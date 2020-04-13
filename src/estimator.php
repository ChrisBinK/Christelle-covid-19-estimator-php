<?php

require_once("impact.php");
require_once("severeImpact.php");

function covid19ImpactEstimator($data)
{
  // Convert to object
  $jsonArray = array();
  /*$dataObject  =  $data; //json_decode($data[0]);
  $impact = new Impact($dataObject);
  $severeImpact = new SevereImpact($dataObject);

  $estimatorJson = [
    "data" =>$dataObject,
    "impact"=> $impact,
    "severeImpact"=>$severeImpact
  ];*/
  
  foreach($data  as $array){

    foreach ($array as $item){
      $dataObject  =  json_decode($item);
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



 
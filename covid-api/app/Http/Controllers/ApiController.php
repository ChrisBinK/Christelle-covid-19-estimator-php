<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Impact;
use App\SevereImpact;

class ApiController extends Controller
{
    public function getEstimate(Request $request) {
      
     
      $impact = new Impact($request->reportedCases,  $request->periodType,  $request->timeToElapse, $request->totalHospitalBeds,  $request->population, $request->region['avgDailyIncomeInUSD'],$request->region['avgDailyIncomePopulation']);
      $severeImpact = new SevereImpact($request->reportedCase,   $request->periodType,  $request->timeToElapse, $request->totalHospitalBeds,  $request->population, $request->region['avgDailyIncomeInUSD'],$request->region['avgDailyIncomePopulation']);
  
      $estimatorJson['data'] =  $request->all();
      $estimatorJson['impact'] =  $impact->getArray();
      $estimatorJson['severeImpact'] =  $severeImpact-> getArray();
    
      //return  json_encode($estimatorJson) ; //*/
      return response()->json(json_encode($estimatorJson));


    }

    public function getEstimateXml(Request $request) {
      
     
      $impact = new Impact($request->reportedCases,  $request->periodType,  $request->timeToElapse, $request->totalHospitalBeds,  $request->population, $request->region['avgDailyIncomeInUSD'],$request->region['avgDailyIncomePopulation']);
      $severeImpact = new SevereImpact($request->reportedCase,   $request->periodType,  $request->timeToElapse, $request->totalHospitalBeds,  $request->population, $request->region['avgDailyIncomeInUSD'],$request->region['avgDailyIncomePopulation']);
  
      $estimatorJson['data'] =  $request->all();
      $estimatorJson['impact'] =  $impact->getArray();
      $estimatorJson['severeImpact'] =  $severeImpact-> getArray();
    
      //return  json_encode($estimatorJson) ; //*/
      return response()->xml($estimatorJson);

      
    }
}

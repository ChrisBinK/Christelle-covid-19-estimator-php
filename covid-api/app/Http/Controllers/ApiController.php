<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Impact;
use App\SevereImpact;
use App\Log;
use DateTime;
use Carbon\Carbon;


class ApiController extends Controller
{
    public function getEstimate(Request $request) {
      
      $startTime = Carbon::now();
     
      $impact = new Impact($request->reportedCases,  $request->periodType,  $request->timeToElapse, $request->totalHospitalBeds,  $request->population, $request->region['avgDailyIncomeInUSD'],$request->region['avgDailyIncomePopulation']);
      $severeImpact = new SevereImpact($request->reportedCase,   $request->periodType,  $request->timeToElapse, $request->totalHospitalBeds,  $request->population, $request->region['avgDailyIncomeInUSD'],$request->region['avgDailyIncomePopulation']);
  
      $estimatorJson['data'] =  $request->all();
      $estimatorJson['impact'] =  $impact->getArray();
      $estimatorJson['severeImpact'] =  $severeImpact-> getArray();
    
      $this->logTime($startTime, $request->url());
      return response()->json($estimatorJson);


    }

    public function getEstimateXml(Request $request) {
      
      $startTime = Carbon::now();
 
      $impact = new Impact($request->reportedCases,  $request->periodType,  $request->timeToElapse, $request->totalHospitalBeds,  $request->population, $request->region['avgDailyIncomeInUSD'],$request->region['avgDailyIncomePopulation']);
      $severeImpact = new SevereImpact($request->reportedCase,   $request->periodType,  $request->timeToElapse, $request->totalHospitalBeds,  $request->population, $request->region['avgDailyIncomeInUSD'],$request->region['avgDailyIncomePopulation']);
  
      $estimatorJson['data'] =  $request->all();
      $estimatorJson['impact'] =  $impact->getArray();
      $estimatorJson['severeImpact'] =  $severeImpact-> getArray();
    
      $this->logTime($startTime, $request->url());
     // save to db
      return response($estimatorJson, 200) ->header('Content-Type', 'text/xml'); 
    }

    public function logTime($startTime, $url){
      $requestTime = Carbon::now()->diffInSeconds($startTime) ;
      $logs = new Log();
      $logs->requestpath = $url;
      $logs->timeRequest =  "done in ".$requestTime." seconds";
      $logs->save();
    }

    public function getAllLogs() {
      $logs = Log::get();
      $content = "";
      foreach ($logs as $log) {
        $content = $content . "\n ".  $log->timestamp."\t\t".$log->requestpath . "\t\t". $log->timeRequest ;
    }
      return response($content, 200);
    }
}

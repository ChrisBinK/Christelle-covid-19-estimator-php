<?php

Class Impact implements JsonSerializable
{
    private $className = 'impact';
    protected $hospitalBedsByRequestedTime;
    protected $casesForICUByRequestedTime;
    protected $casesForVentilatorsByRequestedTime;
    protected $dollarsInFlight;

    protected $currentlyInfected;
    protected $infectionsByRequestedTime;
    protected $severeCasesByRequestedTime;
    protected $numberOfDays; // this value is et when calculating  infection by requested time
   

    /**
     * Constructor to initialse the object
     * 
     */
    public function __construct($reportedCases, $periodType,$timeToElapse, $totalHospitalBeds,$population, $avgDailyIncomeInUSD,$avgDailyIncomePopulation){
        $this->currentlyInfected = (int)  $reportedCases * 10;
        $this->estimate($periodType,$timeToElapse, $totalHospitalBeds,$population, $avgDailyIncomeInUSD,$avgDailyIncomePopulation);
    }

    public function estimate($periodType,$timeToElapse, $totalHospitalBeds,$population, $avgDailyIncomeInUSD,$avgDailyIncomePopulation){
        // calculate infection by requested time
        $this->infectionsByRequestedTime =  $this->calculateInfectionByRequestedTime($periodType, $timeToElapse);

        $this->severeCasesByRequestedTime = floor(($this->infectionsByRequestedTime * 0.15));
        $this->hospitalBedsByRequestedTime = (int)($totalHospitalBeds * (35/100))  - (int) $this->severeCasesByRequestedTime ;
        $this->casesForICUByRequestedTime = floor($this->infectionsByRequestedTime * (5/100));
        $this->casesForVentilatorsByRequestedTime = floor(($this->infectionsByRequestedTime * (2/100)));
   
        $this->dollarsInFlight =  round($this->infectionsByRequestedTime * $avgDailyIncomePopulation * $avgDailyIncomeInUSD *  $this->numberOfDays, 0); // I have conerted the days  or monh timeToElapse to days
      
    }
    public function calculateInfectionByRequestedTime($periodType, $timeToElapse){
        $factor = 0;
        $periodType = strtolower(trim($periodType));
        if($periodType =="days"){
            $this->numberOfDays = $timeToElapse;
            $factor =  (int) ( $this->numberOfDays / 3);     
        }
        if( $periodType =="weeks"){
            $this->numberOfDays = $timeToElapse * 7;  // cause there are  7 days in a week
            $factor =  (int) ($this->numberOfDays / 3); // calculate the factor
        }
        if($periodType =="months"){
            //  Assume each month has  30 days
            $this->numberOfDays = $timeToElapse *  30;  // Calculate the number of days from the months in timeToElapse
            $factor =  (int)($this->numberOfDays / 3);
        }
        return  (int) ($this->currentlyInfected * pow(2, $factor));
       
    }

    public function getArray(){
        $arrayImpact = null;
        $arrayImpact ['currentlyInfected'] = $this->currentlyInfected;
        $arrayImpact ['infectionsByRequestedTime'] = $this->infectionsByRequestedTime;
        $arrayImpact ['severeCasesByRequestedTime'] = $this->severeCasesByRequestedTime;
        $arrayImpact ['hospitalBedsByRequestedTime'] = $this->hospitalBedsByRequestedTime;
        $arrayImpact ['casesForICUByRequestedTime'] = $this->casesForICUByRequestedTime;
        $arrayImpact ['casesForVentilatorsByRequestedTime'] = $this->casesForVentilatorsByRequestedTime;
        $arrayImpact ['dollarsInFlight'] = $this->dollarsInFlight;
        return $arrayImpact;

    }

    public function jsonSerialize() {
        return [
            
            'currentlyInfected' => $this->currentlyInfected,
            'infectionsByRequestedTime' => $this->infectionsByRequestedTime,
            'severeCasesByRequestedTime' => $this->severeCasesByRequestedTime,
            'hospitalBedsByRequestedTime' => $this->hospitalBedsByRequestedTime,
            'casesForICUByRequestedTime' => $this->casesForICUByRequestedTime,
            'casesForVentilatorsByRequestedTime' => $this->casesForVentilatorsByRequestedTime,
            'dollarsInFlight' => $this->dollarsInFlight
        
        ];
    }


}
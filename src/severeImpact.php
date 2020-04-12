<?php

require_once("impact.php");

Class SevereImpact extends Impact
{
    
    public function __construct($data){
      
        $this->currentlyInfected  =   $data->reportedCases * 50;
        $this->estimate($data);

    }

}
<?php 

require "./RobinInterface.php";

class SmoothWeightedRebin implements RobinInterface
{
    private $services=[];

    private $total;

    private $currentPos=-1;

    public function init(array $services){
        foreach($services as $ip=>$weight){
            $this->services[]=[
                'ip'=>$ip,
                'weight'=>$weight,
                'current_weight'=>$weight
            ];
        }

        $this->total=count($this->services);
    }

    public function next(){

    }

    public function getMaxCurrentWeightPos(){

    }

    public function getSumWeight(){

    }

    public function getCurrentWeight(){

    }

    public function recoverCurrentWeight(){
        
    }
}
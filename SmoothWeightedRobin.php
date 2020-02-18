<?php 

require "RobinInterface.php";

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
        $this->currentPos=$this->getMaxCurrentWeightPos();
        $currentWeight = intval($this->getCurrentWeight($this->currentPos)) - intval($this->getSumWeight());
        $this->setCurrentWeight($this->currentPos, $currentWeight);
        $this->recoverCurrentWeight();
        return $this->services[$this->currentPos]['ip'];
    }

    public function getMaxCurrentWeightPos(){
        $currentWeight=$pos=0;
        foreach($this->services as $index=>$service){
            if($service['current_weight'] > $currentWeight){
                $currentWeight=$service['current_weight'];
                $pos=$index;
            }
        }
        return $pos;
    }

    public function getSumWeight(){
        $sum=0;
        foreach($this->services as $service){
            $sum+=intval($service['weight']);
        }
        return $sum;
    }

    public function setCurrentWeight($pos,$weight){
        $this->services[$pos]['current_weight']=$weight;
    }

    public function getCurrentWeight($pos){
        return $this->services[$pos]['current_weight'];
    }

    public function recoverCurrentWeight(){
        foreach ($this->services as $index => &$service) {
            $service['current_weight'] += intval($service['weight']);
        }
    }
}
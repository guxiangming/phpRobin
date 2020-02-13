<?php



require "RobinInterface.php";

class WeightedRobin implements RobinInterface{

       private $services=array();
       private $total;
       private $currentPos=-1;
       private $currentWeight;

       public function init(array $services){

        foreach ($services as $ip=>$weight){
            $this->services[]=[
                'ip'=>$ip,
                'weight'=>$weight
            ];
        }
        $this->total=count($this->services);

    }

    public function next(){
        $i=$this->currentPos;
        while(true){
            
            $i=($i+1)%$this->total;
            // echo $i;
            if(0===$i){
                $this->currentWeight-=$this->getGcd(); //1
                if($this->currentWeight<=0){
                    $this->currentWeight=$this->getMaxWeight();
                }
            }

            if($this->services[$i]['weight']>=$this->currentWeight){
                //第一次 0
                $this->currentPos=$i;
                return $this->services[$this->currentPos]['ip'];
            }
        }
    }

    public function gcd($a,$b){
        $rem=0;
        while($b){
            $rem=$a%$b;
            $a=$b;
            $b=$rem;
        }
        return $a;
        
    }


    public function getGcd(){
        $gcd=$this->services[0]['weight'];
        for($i=0;$i<$this->total;$i++)
        {
            $gcd=$this->gcd($gcd,$this->services[$i]['weight']);
        }
        //1
        return $gcd;
    }

    public function getMaxWeight(){
        $maxWeight=0;
        foreach($this->services as $node){
            if($node['weight']>=$maxWeight){
                $maxWeight=$node['weight'];
            }

        }
        return $maxWeight;
    }
}

$a=new WeightedRobin();
$a->init([
    '192.168.10.1' => 5,
    '192.168.10.2' => 1,
    '192.168.10.3' => 1,
]);
$a->next();
// $res=[
// $a->next(),
// $a->next(),
// $a->next(),
// $a->next(),
// $a->next(),
// $a->next(),
// $a->next(),
// $a->next(),

// $a->next(),
// $a->next(),
// $a->next(),
// $a->next(),
// $a->next(),
// $a->next(),
// $a->next(),
// $a->next(),

// ];
// var_export(
//     $res
// );
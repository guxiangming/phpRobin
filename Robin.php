<?php

namespace Robin;

class Robin implements RobinInterface
{
    private $services=array();
    private $total;
    private $currentPos=-1;

    public function init(array $services)
    {
        $this->services=$services;
        $this->total=count($services);
    }

    public function next(){
        $this->currentPos=($this->currentPos+1)%$this->total;
        return $this->services[$this->currentPos];
    }
}
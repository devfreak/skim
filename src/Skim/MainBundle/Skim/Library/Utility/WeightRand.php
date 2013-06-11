<?php

namespace Skim\MainBundle\Skim\Library\Utility;

class WeightRand
{

	private $weights;
	private $objects;

	public function add($weight, $object)
	{
		$this -> weights[] = $weight;
		$this -> objects[] = $object;
	}

	public function randObject() { 

            $res = 1000000000; 
            $rn = mt_rand(0, $res - 1); 
            $psum = 0;
            
            foreach($this->weights as $element => $probability) 
            { 
            	$psum += $probability * $res; 
            	if ($psum > $rn) return $this->objects[$element]; 
            } 

            return false; 
      
     } 

}
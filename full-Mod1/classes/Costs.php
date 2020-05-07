<?php
/**
 * Class Costs
 * 
 * This class brings together all the costs for calculating
 * the cost of carpet
 */
include_once 'Rooms.php';
include_once 'Price.php';

class Costs
{
    //constants
    const BLM_DIV = 3.66;
    const WASTE = 0.12;
    const GST = 0.10;

    protected $totalArea;
    protected $blm;
    protected $price; /* Price */
    protected $totalCost;
    protected $discount_pc;
    protected $discount_amount;
    protected $excl_cost;
    protected $gst;
    protected $incl_cost;

    /**
     * Load all variables and calculate costs
     * 
     * @param \Rooms $rooms
     * @param string $quality
     * @param float $discount_pc
     * 
     */
    public function calcCosts($rooms, $quality, $discount_pc){

        //Inputs
        $this->totalArea = $rooms->getTotalArea();
        $this->blm = $this->getBlm();
        $this->price = new Price($quality);

        //Calculations
        if(empty($discount_pc)){
            $this->discount_pc = 0;
        }else{
            $this->discount_pc = $discount_pc;
        }
        $this->totalCost = $this->blm * $this->price->getPrice();
        $this->discount_amount = $this->totalCost * ($this->discount_pc/100);
        
        $this->excl_cost = $this->totalCost - $this->discount_amount;
        $this->gst = $this->excl_cost * self::GST;
        $this->incl_cost = $this->excl_cost + $this->gst;

    }

    /**
     * Get the value of totalArea
     */ 
    public function getTotalArea()
    {
        return $this->totalArea;
    }

    /**
     * Calculate total broad loom metres
     *
     * 
     */
    public function getBlm(){

        return ceil($this->getTotalArea() * (1 + self::WASTE) / self::BLM_DIV);

    }



    /**
     * Get the value of totalCost
     */ 
    public function getTotalCost()
    {
        return number_format($this->totalCost, 2);
    }

    /**
     * Get the value of discount_amount
     */ 
    public function getDiscount_amount()
    {
        return number_format($this->discount_amount, 2);
    }

    /**
     * Get the value of excl_cost
     */ 
    public function getExcl_cost()
    {
        return number_format($this->excl_cost, 2);
    }

    /**
     * Get the value of gst
     */ 
    public function getGst()
    {
        return number_format($this->gst, 2);
    }

    /**
     * Get the value of incl_cost
     */ 
    public function getIncl_cost()
    {
        return number_format($this->incl_cost, 2);
    }

    /**
     * Get quality from Price
     */
    public function getQuality(){
        return $this->price->getQuality();
    }
}
<?php
/**
 * Carpet Calculation Class
 * 
 * 
 * Usage:
 * 
 * 1. addRooms - using GET arraysof widths and lengths
 * 2. calcCosts - using quality and discount percentage
 * 
 */

class CarpetCalc
{
    //constants
    const BLM_DIV = 3.66;
    const WASTE = 0.12;
    const GST = 0.10;

    protected $rooms = [];

    public $totalArea = 0;
    public $quality = "";
    public $totalCost = 0;
    public $discount_amount = 0;
    public $discount_pc = 0;
    public $excl_cost = 0;
    public $gst = 0;
    public $incl_cost = 0;

    /**
     * Add Rooms for calculation. 
     * This comes from the user input arrays
     * 
     * @param: int array $arWidths
     * @param: int array $arLengths
     * 
     */

    public function addRooms($arWidths, $arLengths){

        for($i = 0; $i < count($arWidths); $i++){

            if(!empty($arWidths[$i] && !empty($arLengths[$i]))){
                $this->rooms[] = [$arWidths[$i], $arLengths[$i]];
            }
        }
    }

    /**
     * Return the number of rooms being carpetted
     */

    public function numRooms(){
        return count($this->rooms);
    }

    /**
     * Calculate the total Area of carpet required
     */ 
    public function calcArea(){
        $this->totalArea = 0;
        foreach ($this->rooms as $room) {
            $this->totalArea += $room[0] * $room[1];
        }
        return $this->totalArea;
    }
 
    /**
     * Calculate total broad loom metres
     */
    public function getBlm(){

        return ceil($this->calcArea() * (1 + self::WASTE) / self::BLM_DIV);

    }

    /**
     * Get price from given quality
     * 
     * @param: string $quality
     * 
     * one of: standard, premium, executive
     */

    public function getPrice($quality){

        if($quality == "standard"){
            $price = 120.00;
        }elseif($quality == "premium"){
            $price = 180.00;
        }elseif($quality == "executive"){
            $price = 210.00;
        }else{
            exit("Error - Quality $quality is not valid");
        }

        //Save for output later
        $this->quality = $quality;
        return $price;
    }
    public function getPrice_alt($quality){
        //Alternate way

        $prices = [
            "Standard" => 120.00,
            "Premium" => 180.00,
            "Executive" => 210.00
        ];
        if(isset($prices[$quality])){
            //Save for output later
            $this->quality = $quality;
            return $prices[$quality];
        }else{
            throw new Exception("Price for quality ".$quality." not found");
        }

     }

     /**
      * Main Calculation Function
      */
    public function calcCosts($quality, $discount_pc){

        assert($this->numRooms() > 0);

             //Calculations
        $this->totalCost = $this->getBlm() * $this->getPrice($quality);
        $this->discount_amount = $this->totalCost * ($discount_pc/100);
        $this->discount_pc = $discount_pc;
        $this->excl_cost = $this->totalCost - $this->discount_amount;
        $this->gst = $this->excl_cost * self::GST;
        $this->incl_cost = $this->excl_cost + $this->gst;

    }
}
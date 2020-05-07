<?php
/**
 * class Price
 * 
 * Return price, based on quality
 */

class Price
{
    protected $quality;

    protected $data = [
        "Standard" => 120.00,
        "Premium" => 180.00,
        "Executive" => 210.00
    ];

    public function __construct($quality)
    {
        $this->quality = $quality;
    }

    public function getPrice(){
        if(isset($this->data[$this->quality])){
            return $this->data[$this->quality];
        }else{
            throw new Exception("Price for quality ".$this->quality." not found");
        }
    }

    /**
     * Get the value of quality
     */ 
    public function getQuality()
    {
        return $this->quality;
    }
}
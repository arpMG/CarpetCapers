<?php
/**
 * Class Room
 * 
 * width and length of room
 * 
 * used in conjuction with Rooms class
 */

class Room
{
    protected $width;
    protected $length;

    public function __construct($width, $length){

        if(!empty($width) && !empty($length)){

            $this->width = $width;
            $this->length = $length;
            
            // $this->area = $this->width * $this->length;
        }else{
            throw new Exception("width and length must be greater than 0");
        }
    }
    public function getArea(){

        return ($this->width *  $this->length);

    }
}
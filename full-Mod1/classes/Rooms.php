<?php
/**
 * class Rooms
 * 
 * builds array of class Room
 * 
 */

include_once "Room.php";

class Rooms
{
    protected $rooms = [];
    protected $totalArea = null;

    /**
     * Add one room at a time
     */
    public function addRoom($width, $length){
        try{

            $temp = new Room($width, $length);
            $this->rooms[] = $temp;

        } catch (Exception $e){
            //log error
        }
    }

    /**
     * Add array of rooms from array of widths and lengths
     * 
     * such as from user input form
     */
    public function addRooms($arrWidths, $arrLengths){
        array_map(array($this, 'addRoom'), $arrWidths, $arrLengths);

    }

    /**
     * return the number of rooms
     */
    public function numRooms(){
        return count($this->rooms);
    }

    /**
     * Calculate total area
     * 
     * If this has already been calculated just return it
     * 
     */
    public function getTotalArea(){

        if(empty($this->totalArea)){
            $this->totalArea = 0;
            foreach($this->rooms as $room){
                $this->totalArea += $room->getArea();
            }
        }

        return $this->totalArea;
    }

}
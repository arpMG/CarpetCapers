<?php
/**
 * Class Prices
 * 
 * Reads xml prices file
 * 
 * Format: 
 * <quality>
 *  String name
 *  Float pice
 * </quality>
 */

Class Prices
{
    protected $data = []; //associative array

    public function __construct($xmlfile)
    {
        $file = new XMLReader();
        $file->open($xmlfile);

        while($file->read() && $file->name !== 'quality'); //skip to first <quality>

        while($file->name === 'quality'){

            $element = new SimpleXMLElement($file->readOuterXml());

            //Use Associative array
            $this->data[trim((string)$element->name)] = (float)$element->price;

            $file->next('quality');    //Move to the next <food>
        }        
    }

    public function getData(){

        return $this->data;
    }

    public function getPrice($quality){

        if(!empty($this->data[$quality])){
            return $this->data[$quality];
        }else{
            throw new Exception("Carpet Quality ".$quality." does not exist");
        }

    }
}
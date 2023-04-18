<?php

namespace App\Models;

class Block
{
    private $id;
    private $width = 1;
    private $position;
    private $orientation;
    private $size;

    public function __construct($id, $x, $y, $orientation, $size)
    {
        $this->id = $id;
        $this->position = [$y-1, $x-1];
        $this->orientation = $orientation;
        $this->size = $size;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getOrientation()
    {
        return $this->orientation;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function move($vector){
        if($this->getOrientation() === 'h'){
            $this->position[1] = $this->position[1] + $vector;
           
        }else{
            $this->position[0] = $this->position[0] + $vector;
        }
    }
}
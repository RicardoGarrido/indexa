<?php

namespace App\Models;

class Board
{
    private $matrix;
    private $size;
    private $blocks;

    public function __construct($size)
    {
        $this->matrix = array_fill(0, $size, array_fill(0, $size, null));
        $this->size = $size;
        $this->blocks = [];
    }

    public function getBlockById($blockID){
        return data_get($this->blocks, $blockID, false);
    }

    public function getMatrix()
    {
        return $this->matrix;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function checkCollision(Block $block)
    {
        $blockId = $block->getID();
        $position = $block->getPosition();
        $orientation = $block->getOrientation();
        $size = $block->getSize();
        $row = $position[0];
        $col = $position[1];

        if ($orientation === 'h') {
            for ($i = $col; $i < $col + $size; $i++) {
                if ($col + $size > $this->size || $row > $this->size ||//border overlapse
                    ($this->matrix[$row][$i] !== null && $this->matrix[$row][$i] !== $blockId) //block overlapse
                 ) {
                    return true;
                }
            }
        } else {
            for ($i = $row; $i < $row + $size; $i++) {
                if ($row + $size > $this->size ||  $col > $this->size || //border overlapse 
                    ($this->matrix[$i][$col] !== null && $this->matrix[$i][$col] !== $blockId)//block overlapse
                 ) {
                    return true;
                }
            }
        }

        return false;
    }

    public function moveBlock($blockID, $movement){
        $block = $this->getBlockById($blockID);
        $orientation = $block->getOrientation();
        $size = $block->getSize();

        $originalPosition = $block->getPosition();
        $originalRow = $originalPosition[0];
        $originalCol = $originalPosition[1];

        $block->move($movement);
       
        if ($this->checkCollision($block)) {
            $block->move(- $movement);
            return false;
        }

        $this->blockPosition($orientation, $originalCol, $originalRow, $size, null);
        $newPosition = $block->getPosition();
        $newRow = $originalPosition[0];
        $newCol = $originalPosition[1];
        $this->blockPosition($orientation, $newCol, $newRow, $size, null);
        return true;
    }


    public function blockPosition($orientation, $col, $row, $size,$blockId ){
        if ($orientation === 'h') {
            for ($i = $col; $i < $col + $size; $i++) {
                $this->matrix[$row][$i] = $blockId;
            }
        } else {
            for ($i = $row; $i < $row + $size; $i++) {
                $this->matrix[$i][$col] = $blockId;
            }
        }
    }

    public function addBlock(Block $block)
    {
        $blockId = $block->getID();

        if ($this->checkCollision($block)) {
            throw new \Exception('Block collision detected');
        }

        if ($this->getBlockById($blockId)) {
            throw new \Exception('Duplicated Block');
        }

        $this->blocks[$blockId]= $block;
        $position = $block->getPosition();
        $orientation = $block->getOrientation();
        $size = $block->getSize();
        $row = $position[0];
        $col = $position[1];

        $this->blockPosition($orientation, $col, $row, $size, $blockId );
    }
}
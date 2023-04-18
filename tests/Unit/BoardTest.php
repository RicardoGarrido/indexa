<?php

namespace Tests\Unit;

use App\Models\Block;
use App\Models\Board;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    public function testDuplicatedBlock()
    {
        $this->expectExceptionMessage('Duplicated Block');
        $board = new Board(7);
        $block1 = new Block(0, 2, 3, 'h', 5);
        $block2 = new Block(0,3, 1, 'v', 1);
        $board->addBlock($block1);
        $board->addBlock($block2);
    }


    public function testMovementBlock()
    {
        $board = new Board(7);
        $block1 = new Block(0, 1, 3, 'h', 1);
        $block2 = new Block(1,5, 3, 'v', 1);
        $board->addBlock($block1);
        $board->addBlock($block2);
        $this->assertEquals(true, $board->moveBlock(0,1),"it should be a legal movement");
        $this->assertEquals(false, $board->moveBlock(0,3),"it should be a ilegal movement");
        $this->assertEquals(true, $board->moveBlock(0,4),"it should be a legal movement");
    }
}

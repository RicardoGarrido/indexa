<?php

namespace Tests\Feature;

use App\Models\Block;
use App\Models\Board;
use Tests\TestCase;


class ColisionTest extends TestCase
{

    /**
     * @dataProvider collisionProvider
     */
    public function testBlockCollision($block1, $block2, $expected, $msg, $throwError = false)
    {
        if($throwError){
            $this->expectExceptionMessage('Block collision detected');
        }

        $board = new Board(6);
        $board->addBlock($block1);
        $this->assertEquals($expected, $board->checkCollision( $block2),$msg);
    }

    public function collisionProvider()
    {
        return [
            'Case a does not collide' => [
                new Block(0, 2, 3, 'h', 5),
                new Block(1,3, 1, 'v', 1),
                false,
                "In case a, the blocks do not collide."
            ],
            'Case b collides' =>[  
                new Block(0, 2, 3, 'h', 1),
                new Block(1, 2, 3, 'h', 1),
                true,
                "In case b, the blocks collide."
            ],
            'Case c collides' =>[  
                new Block(0, 2, 3, 'h', 5),
                new Block(1, 3, 3, 'h', 2),
                true,
                "In case c, the blocks collide."
            ],
            'Case d does not collide' =>[  
                new Block(0, 2, 3, 'h', 5),
                new Block(1, 4, 1, 'h', 2),
                false,
                "In case d, the blocks do not collide."
            ],
            'Case e collides' =>[  
                new Block(0, 2, 3, 'h', 5),
                new Block(1, 3, 1, 'v', 3),
                true,
                "In case e, the blocks collide."
            ],
            'Case f collides with the limits of the board' =>[  
                new Block(0, 8, 7, 'h', 2),
                new Block(1, 10, 7, 'v', 6),
                true,
                "In case f, the blocks do not collide, but exceed the board limits",
                true
            ],
            'Case g does not collide' =>[  
                new Block(0, 2, 3, 'h', 5),
                new Block(1, 3, 1, 'v', 2),
                false,
                "In case g, the blocks do not collide."
            ],
            'Case h collides' =>[  
                new Block(0, 4, 3, 'h', 3),
                new Block(2, 6, 2, 'v', 2),
                true,
                "In case h, the blocks collide."
            ],
            'Case i does not collide' =>[  
                new Block(0, 3, 3, 'v', 2),
                new Block(1, 3, 5, 'v', 2),
                false,
                "In case i, the blocks do not collide."
            ],
            'Case j does not collide' =>[  
                new Block(0, 1, 3, 'h', 2),
                new Block(1, 5, 3, 'h', 2),
                false,
                "In case j, the blocks do not collide."
            ],

        ];
    }
}



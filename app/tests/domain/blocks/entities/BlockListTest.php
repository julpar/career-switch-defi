<?php
declare(strict_types=1);

namespace app\tests\domain\blocks\entities;

use app\domain\blocks\entities\Block;
use app\domain\blocks\entities\BlockList;
use app\domain\blocks\entities\BlockListInterface;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Mockery as m;

/**
 * @covers BlockList
 */
class BlockListTest extends TestCase
{
    private BlockList $sut;
    
    public function testInvalidBlockTypeInt(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new BlockList([1, 2, 3]);
    }

    public function testInvalidBlockTypeString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new BlockList(["1", "2", "3"]);
    }
    
    public function testValidInstance(): void
    {
        $values = [
            m::spy(Block::class),
            m::spy(Block::class)
        ];

        $this->assertInstanceOf(BlockList::class, new BlockList($values));
    }
    
    public function testValidInterfaceImplementation(): void
    {
        $values = [
            m::spy(Block::class),
            m::spy(Block::class)
        ];
        
        $this->assertInstanceOf(BlockListInterface::class, new BlockList($values));
    }
    
    public function testCreateFromHashes(): void
    {
        $values = ["1", "2", "3"];

        $blockList = BlockList::createFromHashesList($values);
        
        $this->assertEquals($blockList->toStringArray(), $values);
    }
    
    
}


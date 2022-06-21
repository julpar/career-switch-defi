<?php
declare(strict_types=1);

namespace app\tests\domain\blocks\entities;

use app\domain\blocks\entities\Block;
use app\domain\blocks\entities\BlockInterface;
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

    public function testGetRemaining(): void
    {
        $values = ["1", "2", "3"];

        $blockList = BlockList::createFromHashesList($values);

        $this->assertEquals(["2", "3"], $blockList->getRemaining()->toStringArray());
    }

    public function testEmpty(): void
    {
        $blockList = BlockList::createFromHashesList([]);

        $this->assertTrue($blockList->isEmpty());
        $this->assertEquals(0, $blockList->count());
    }

    public function testEquals(): void
    {
        $blockList = BlockList::createFromHashesList(["1", "2", "3"]);

        $this->assertEquals(3, $blockList->count());
    }

    public function testToArray(): void
    {
        $blockList = BlockList::createFromHashesList(["1", "2", "3"]);

        $result = $blockList->toArray();
        
        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(BlockInterface::class, $result);
        $this->assertEquals(3, count($result));
        $this->assertEquals(array_map(fn (BlockInterface $block) => $block->hash(), $result), $result);
    }

    public function testGetFirst(): void
    {
        $firstElement = "aaaa";
        $blockList = BlockList::createFromHashesList([$firstElement, "bbbb", "ccccc"]);

        $result = $blockList->getFirst();

        $this->assertInstanceOf(BlockInterface::class, $result);
        $this->assertEquals($firstElement, $result->hash());
    }

    public function testGetIterator(): void
    {
        $blockList = BlockList::createFromHashesList(["1", "2", "3"]);

        $iterator = $blockList->getIterator();

        $this->assertEquals("1", $iterator->current()->hash());
        $this->assertEquals("2", $iterator->next()->hash());
        $this->assertNotEquals("1", $iterator->current()->hash());
        $this->assertEquals("3", $iterator->next()->hash());
        $this->assertFalse($iterator->next());
    }
}

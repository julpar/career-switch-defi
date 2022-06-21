<?php
declare(strict_types=1);

namespace app\tests\domain\blocks\actions\iterator;

use app\domain\blocks\entities\BlockList;
use PHPUnit\Framework\TestCase;
use app\domain\blocks\actions\sort\iterator\BlockIterator;

/**
 * @covers BlockIterator
 */
class BlockIteratorTest extends TestCase
{
    public function testGetIterator(): void
    {
        $blockListMock = ["1", "2", "3"];
        $blockList = BlockList::createFromHashesList($blockListMock);

        $iterator = $blockList->getIterator();

        $this->assertEquals("1", $iterator->current()->hash());
        $this->assertEquals("2", $iterator->next()->hash());
        $this->assertNotEquals("1", $iterator->current()->hash());
        $this->assertEquals("3", $iterator->next()->hash());
        $this->assertFalse($iterator->next());
    }
}

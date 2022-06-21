<?php
declare(strict_types=1);

namespace app\tests\domain\blocks;

use app\domain\blocks\actions\BlockSorterInterface;
use app\domain\blocks\BlocksManager;
use app\domain\blocks\entities\BlockList;
use app\domain\blocks\entities\BlockListInterface;
use app\infrastructure\api\RooftopBlocksAPIClientInterface;

use app\tests\utils\MemberAccessor;
use PHPUnit\Framework\TestCase;
use Mockery as m;

/**
 * @covers BlockList
 */
class BlocksManagerTest extends TestCase
{
    private BlocksManager $sut;

    public function setUp(): void
    {
        parent::setUp();

        /** @psalm-suppress InvalidArgument */
        $this->sut = new BlocksManager(m::mock(RooftopBlocksAPIClientInterface::class));
    }

    public function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }


    public function testSort(): void
    {
        $blockListMock = [ "1", "3", "4", "2"];
        $orderedListMock = [ "1", "2", "3", "4"];
        $apiTokenMock = 'token';
        
        $this->sut->setAccessToken($apiTokenMock);
        
        $listMock = m::mock(BlockListInterface::class)
            ->shouldReceive('toStringArray')
            ->andReturn($orderedListMock)
            ->once()
            ->getMock();
        
        $sorterMock = m::mock(BlockSorterInterface::class)
            ->shouldReceive('sort')
            ->withArgs(function (BlockListInterface $block) use ($blockListMock) {
                return $blockListMock == $block->toStringArray();
            })
            ->once()
            ->andReturn($listMock)
            ->getMock();

        MemberAccessor::set($this->sut, 'sorter', $sorterMock);
        
        $this->assertEquals($orderedListMock, $this->sut->sort($blockListMock));
    }
}

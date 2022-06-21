<?php
declare(strict_types=1);

namespace app\tests\domain\blocks\actions\sort\strategies;

use app\domain\blocks\entities\BlockInterface;
use app\domain\blocks\entities\BlockList;
use app\infrastructure\api\RooftopBlocksAPIInterface;
use PHPUnit\Framework\TestCase;

use \app\domain\blocks\actions\sort\strategies\BlockSequentialSorter;
use Mockery as m;
use app\tests\utils\MemberAccessor;

/**
 * @covers BlockSequentialSorter::sort
 */
class BlockSequentialSorterTest extends TestCase
{
    private BlockSequentialSorter $sut;
    
    public function setUp(): void
    {
        parent::setUp();

        /** @psalm-suppress InvalidArgument */
        $this->sut = new BlockSequentialSorter(m::mock(RooftopBlocksAPIInterface::class));
    }
    
    public function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function testOrdered(): void
    {
        $blockListMock = [ "1", "2", "3", "4"];
        
        //Since it's ordered, we expect array count minus first calls to check endpoint
        $expectedApiCalls = count($blockListMock) - 1;
        
        $this->setExpectations(
            MemberAccessor::get($this->sut, 'client'),
            $expectedApiCalls
        );
        
        $result = $this->sut->sort(BlockList::createFromHashesList($blockListMock));

        $this->assertEquals($blockListMock, $result->toStringArray());
    }

    public function testWorstOrdered(): void
    {
        $blockListMock = [ "1", "4", "3", "2"];
        $expectedApiCalls = 6;

        $this->setExpectations(
            MemberAccessor::get($this->sut, 'client'),
            $expectedApiCalls
        );

        $result = $this->sut->sort(BlockList::createFromHashesList($blockListMock));

        $this->assertEquals([ "1", "2", "3", "4"], $result->toStringArray());
    }
    
    public function testRandomOrdered(): void
    {
        $blockListMock = [ "1", "7", "6", "3", "4", "2", "5"];
        $expectedApiCalls = 17;

        $this->setExpectations(
            MemberAccessor::get($this->sut, 'client'),
            $expectedApiCalls
        );

        $result = $this->sut->sort(BlockList::createFromHashesList($blockListMock));

        $this->assertEquals([ "1", "2", "3", "4", "5", "6", "7"], $result->toStringArray());
    }
    
    public function testEmpty(): void
    {
        $blockListMock = [] ;
        $expectedApiCalls = 0;

        $this->setExpectations(
            MemberAccessor::get($this->sut, 'client'),
            $expectedApiCalls
        );

        $result = $this->sut->sort(BlockList::createFromHashesList($blockListMock));

        $this->assertEquals([], $result->toStringArray());
    }

    public function testJustOne(): void
    {
        $blockListMock = ["1"] ;
        $expectedApiCalls = 0;

        $this->setExpectations(
            MemberAccessor::get($this->sut, 'client'),
            $expectedApiCalls
        );

        $result = $this->sut->sort(BlockList::createFromHashesList($blockListMock));

        $this->assertEquals(["1"], $result->toStringArray());
    }

    public function testPair(): void
    {
        $blockListMock = ["1", "2"] ;
        $expectedApiCalls = 1;

        $this->setExpectations(
            MemberAccessor::get($this->sut, 'client'),
            $expectedApiCalls
        );

        $result = $this->sut->sort(BlockList::createFromHashesList($blockListMock));

        $this->assertEquals(["1", "2"], $result->toStringArray());
    }

    public function testUneven(): void
    {
        $blockListMock = ["1", "3", "2"] ;
        $expectedApiCalls = 3;

        $this->setExpectations(
            MemberAccessor::get($this->sut, 'client'),
            $expectedApiCalls
        );

        $result = $this->sut->sort(BlockList::createFromHashesList($blockListMock));

        $this->assertEquals(["1", "2", "3"], $result->toStringArray());
    }
    
    private function setExpectations($apiClientMock, int $expectedApiCalls): void
    {
        $apiClientMock->shouldReceive('isNext')
            ->with(
                m::type(BlockInterface::class),
                m::type(BlockInterface::class)
            )->andReturnUsing(function (string $block1, string $block2) {
                return (int) $block2 == (int) $block1 + 1;
            })->times($expectedApiCalls);
    }
}

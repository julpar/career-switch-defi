<?php
declare(strict_types=1);

namespace app\tests\integration\domain\blocks;

use app\domain\blocks\BlocksManager;
use app\domain\blocks\entities\BlockList;
use app\infrastructure\api\RooftopBlocksAPIClientInterface;
use app\tests\utils\MemberAccessor;
use Mockery as m;
use PHPUnit\Framework\TestCase;

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
        $blockListMock = ["1", "3", "4", "2"];
        $orderedListMock = ["1", "2", "3", "4"];
        $apiTokenMock = 'token';

        MemberAccessor::get($this->sut, 'apiClient')
            ->shouldReceive('isNext')
            ->andReturnUsing(function (string $token, string $block1, string $block2) use ($apiTokenMock) {
                return $apiTokenMock === $token && (int)$block2 === (int)$block1 + 1;
            })->times(5);

        $this->sut->setAccessToken($apiTokenMock);

        $this->assertEquals($orderedListMock, $this->sut->sort($blockListMock));
    }
}

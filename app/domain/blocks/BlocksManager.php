<?php
declare(strict_types=1);

namespace app\domain\blocks;

use app\domain\blocks\actions\BlockSorterInterface;
use app\domain\blocks\actions\sort\strategies\BlockSequentialSorter;
use app\domain\blocks\entities\BlockList;
use app\infrastructure\api\RooftopBlocksAPIClientInterface;
use app\infrastructure\api\RooftopBlocksAPIInterface;
use app\infrastructure\api\RooftopBlocksAPIManager;
use Assert\Assert;

class BlocksManager
{
    private RooftopBlocksAPIInterface $apiGateway;
    private BlockSorterInterface $sorter;
    
    public function __construct(
        private RooftopBlocksAPIClientInterface $apiClient,
    ) {
    }

    public function sort(array $blocks): array
    {
        Assert::that($this->apiGateway)->notNull('Access Token must be set');
        
        $sorted = $this->sorter->sort(BlockList::createFromHashesList($blocks));
        return $sorted->toStringArray();
    }

    public function check(array $blocks): bool
    {
        Assert::that($this->apiGateway)->notNull('Access Token must be set');
        return $this->apiGateway->check(BlockList::createFromHashesList($blocks));
    }
    
    public function setAccessToken(string $apiAccessToken): void
    {
        $this->apiGateway = new RooftopBlocksAPIManager($apiAccessToken, $this->apiClient);
        $this->sorter = new BlockSequentialSorter($this->apiGateway);
    }
}

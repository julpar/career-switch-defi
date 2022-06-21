<?php
declare(strict_types=1);

namespace app\domain\blocks;

use app\domain\blocks\actions\BlockCheckOrderedInterface;
use app\domain\blocks\actions\BlockRetrievalInterface;
use app\domain\blocks\actions\BlockSorterInterface;
use app\domain\blocks\entities\BlockListInterface;
use app\infrastructure\api\RooftopBlocksAPIInterface;

class BlocksManager implements BlockSorterInterface, BlockRetrievalInterface, BlockCheckOrderedInterface
{
    private BlockListInterface $blockList;
    
    public function __construct(private RooftopBlocksAPIInterface $api)
    {
        $this->blockList = $this->api->fetchBlocks();
    }

    public function sort(BlockListInterface $blocks): BlockListInterface
    {
        //TODO: Sort
        return $blocks;
    }

    public function getBlocks(): BlockListInterface
    {
        return $this->blockList;
    }

    public function check(BlockListInterface $blocks): bool
    {
        return $this->api->check($blocks);
    }
}

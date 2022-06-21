<?php

namespace app\domain\blocks\actions\sort\strategies;

use app\domain\blocks\actions\BlockSorterInterface;
use app\domain\blocks\entities\BlockInterface;
use app\domain\blocks\entities\BlockList;
use app\domain\blocks\entities\BlockListInterface;
use app\infrastructure\api\RooftopBlocksAPIInterface;
use Assert\Assert;

class BlockSequentialSorter implements BlockSorterInterface
{
    public function __construct(private RooftopBlocksAPIInterface $client)
    {
    }

    public function sort(BlockListInterface $blocks): BlockListInterface
    {
        $firstBlock = $blocks->getFirst();
        
        if (! $firstBlock) {
            return new BlockList([]);
        }

        $remainingBlocks = $blocks->getRemaining();
        
        $nextBlock = $this->findNextFor($firstBlock, $remainingBlocks);

        if ($nextBlock) {
            //Found next block, do a recursive call with remaining elements and chain that together in order on return
            return new BlockList(array_merge(
                [$firstBlock],
                $this->sort($this->orderNextBlockAsFirst($nextBlock, $remainingBlocks))->toArray()
            ));
        }
        
        //No correlation found, we should return current block as last item
        return new BlockList([$firstBlock]);
    }

    /**
     * @psalm-suppress InvalidReturnType
     */
    private function findNextFor(BlockInterface $base, BlockListInterface $blocks): ?BlockInterface
    {
        if ($blocks->isEmpty()) {
            //No other blocks to compare with
            return null;
        }

        $iterator = $blocks->getIterator();
            
        $comparingBlock = $iterator->current();
        
        while ($comparingBlock) {
            Assert::that($comparingBlock)->isInstanceOf(BlockInterface::class);
            /**
             * @psalm-suppress PossiblyInvalidArgument checked above
             */
            if ($this->client->isNext($base, $comparingBlock)) {
                /**
                 * @psalm-suppress InvalidReturnStatement psalm is messing with BlockIteratorInterface::current return type bc it infers it can be "true", but that's not the case
                 */
                return $comparingBlock;
            }

            $comparingBlock = $iterator->next();
        }

        return null;
    }

    private function orderNextBlockAsFirst(BlockInterface $nextBlock, BlockListInterface $remainingBlocks): BlockListInterface
    {
        //Prepare next block to be analyzed
        $remainingExcludingFound = array_diff($remainingBlocks->toArray(), [$nextBlock]);
        return new BlockList(array_merge([$nextBlock], $remainingExcludingFound));
    }
}

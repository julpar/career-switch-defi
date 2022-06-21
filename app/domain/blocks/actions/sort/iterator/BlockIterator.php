<?php

namespace app\domain\blocks\actions\sort\iterator;

use app\domain\blocks\entities\BlockIteratorInterface;
use app\domain\blocks\entities\BlockInterface;
use Assert\Assert;

class BlockIterator implements BlockIteratorInterface
{
    /**
     * @var BlockInterface[]
     */
    private array $blocks;
    
    public function __construct(array $blocks)
    {
        Assert::that($blocks)->all()->isInstanceOf(BlockInterface::class);
        $this->blocks = $blocks;
    }

    public function current(): BlockInterface|bool
    {
        return current($this->blocks);
    }

    public function next(): BlockInterface|bool
    {
        return next($this->blocks);
    }
}

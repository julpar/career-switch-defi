<?php
declare(strict_types=1);

namespace app\domain\blocks\entities;

use Assert\Assert;

class BlockList implements BlockListInterface
{
    /**
     * @var BlockInterface[]
     */
    private array $blocks;
    
    public function __construct(array $blocks)
    {
        Assert::that($blocks)->all()->string('Block list must be strings hashes');
        
        $this->blocks = array_map(function (string $blockHash) {
            return new Block($blockHash);
        }, $blocks);
    }

    public function current(): BlockInterface
    {
        return current($this->blocks);
    }

    public function next(): BlockInterface
    {
        return next($this->blocks);
    }

    public function previous(): BlockInterface
    {
        return prev($this->blocks);
    }

    public function reset(): void
    {
        reset($this->blocks);
    }

    public function toArray(): array
    {
        return $this->blocks;
    }
}

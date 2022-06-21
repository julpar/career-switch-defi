<?php
declare(strict_types=1);

namespace app\domain\blocks\entities;

use app\domain\blocks\actions\sort\iterator\BlockIterator;
use Assert\Assert;

class BlockList implements BlockListInterface
{
    /**
     * @var BlockInterface[]
     */
    private array $blocks;
    
    public function __construct(array $blocks)
    {
        Assert::that($blocks)->all()->isInstanceOf(BlockInterface::class);

        $this->blocks = array_values($blocks);
    }
    
    public static function createFromHashesList(array $blocks): BlockListInterface
    {
        Assert::that($blocks)->all()->string('Blocks must be strings hashes');
        Assert::that($blocks)->all()->notEmpty('Blocks must be non-empty strings hashes');
        
        $blocks = array_map(function (string $blockHash) {
            return new Block($blockHash);
        }, $blocks);

        return new self($blocks);
    }
    
    
    public function getFirst(): ?BlockInterface
    {
        return $this->blocks[0] ?? null;
    }

    public function getIterator(): BlockIteratorInterface
    {
        return new BlockIterator($this->blocks);
    }

    public function getRemaining(): BlockListInterface
    {
        $remaining = array_diff($this->blocks, [$this->blocks[0]]);
        return new BlockList($remaining);
    }

    /**
     * @return BlockInterface[]
     */
    public function toArray(): array
    {
        return $this->blocks;
    }

    /**
     * @return string[]
     */
    public function toStringArray(): array
    {
        return array_map(fn(BlockInterface $block) => $block->hash(), $this->blocks);
    }

    public function isEmpty(): bool
    {
        return empty($this->blocks);
    }

    public function count(): int
    {
        return count($this->blocks);
    }
}

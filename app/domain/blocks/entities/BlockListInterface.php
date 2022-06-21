<?php
namespace app\domain\blocks\entities;

interface BlockListInterface
{
    public function getFirst(): ?BlockInterface;
    public function getIterator(): BlockIteratorInterface;
    public function getRemaining(): BlockListInterface;
    public function toArray(): array;
    public function toStringArray(): array;
    public function isEmpty(): bool;
    public function count(): int;
}
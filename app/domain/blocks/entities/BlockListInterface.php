<?php
namespace app\domain\blocks\entities;

interface BlockListInterface
{
    public function current(): BlockInterface;
    public function next(): BlockInterface;
    public function previous(): BlockInterface;
    public function toArray(): array;
    public function reset(): void;
}
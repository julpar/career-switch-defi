<?php
declare(strict_types=1);

namespace app\domain\blocks\entities;

class Block implements BlockInterface
{
    public function __construct(private string $hash)
    {
    }

    public function hash(): string
    {
        return $this->hash;
    }

    public function __toString(): string
    {
        return $this->hash();
    }
}

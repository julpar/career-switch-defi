<?php
namespace app\domain\blocks\entities;

interface BlockInterface extends \Stringable
{
    public function hash(): string;
}

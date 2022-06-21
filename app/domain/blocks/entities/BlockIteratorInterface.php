<?php
namespace app\domain\blocks\entities;

interface BlockIteratorInterface
{
    public function current(): BlockInterface|bool;
    public function next(): BlockInterface|bool;
}
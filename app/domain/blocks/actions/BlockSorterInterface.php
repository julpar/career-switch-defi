<?php

namespace app\domain\blocks\actions;

use app\domain\blocks\entities\BlockListInterface;

interface BlockSorterInterface
{
    public function sort(BlockListInterface $blocks): BlockListInterface;
}

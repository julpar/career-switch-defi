<?php

namespace app\domain\blocks\actions;

use app\domain\blocks\entities\BlockListInterface;

interface BlockCheckOrderedInterface
{
    public function check(BlockListInterface $blocks): bool;
}

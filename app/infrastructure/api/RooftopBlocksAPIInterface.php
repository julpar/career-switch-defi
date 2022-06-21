<?php

namespace app\infrastructure\api;

use app\domain\blocks\entities\BlockInterface;
use app\domain\blocks\entities\BlockListInterface;

interface RooftopBlocksAPIInterface
{
    public function fetchBlocks(): BlockListInterface;
    public function isNext(BlockInterface $base, BlockInterface $nextCandidate): bool;
    public function check(BlockListInterface $blocks): bool;
}
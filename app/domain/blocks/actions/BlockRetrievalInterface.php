<?php

namespace app\domain\blocks\actions;

use app\domain\blocks\entities\BlockListInterface;

interface BlockRetrievalInterface
{
    public function getBlocks(): BlockListInterface;
}

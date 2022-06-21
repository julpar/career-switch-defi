<?php

namespace app\infrastructure\api;

use app\domain\blocks\entities\BlockInterface;
use app\domain\blocks\entities\BlockList;
use app\domain\blocks\entities\BlockListInterface;

class RooftopBlocksAPIManager implements RooftopBlocksAPIInterface
{
    public function __construct(
        private string $accessToken,
        private RooftopBlocksAPIClientInterface $client,
    ) {
    }

    public function fetchBlocks(): BlockListInterface
    {
        $blocks = $this->client->getBlocks($this->accessToken);
        return BlockList::createFromHashesList($blocks);
    }

    /**
     * @psalm-suppress InvalidReturnType Valid return type is enforced by client interface
     */
    public function isNext(BlockInterface $base, BlockInterface $nextCandidate): bool
    {
        return $this->client->isNext($this->accessToken, $base->hash(), $nextCandidate->hash());
    }

    public function check(BlockListInterface $blocks): bool
    {
        return $this->client->check(
            $this->accessToken,
            $blocks->toStringArray()
        );
    }
}

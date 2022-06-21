<?php

namespace app\infrastructure\api;

interface RooftopBlocksAPIClientInterface
{
    public function getBlocks(): array;
    public function isNext(string $base, string $nextCandidate): bool;
    public function check(array $blocks): bool;
}
<?php

namespace app\infrastructure\api;

interface RooftopBlocksAPIClientInterface
{
    public function getBlocks(string $accessToken): array;
    public function isNext(string $accessToken, string $base, string $nextCandidate): bool;
    public function check(string $accessToken, array $blocks): bool;
    public function fetchAccessToken(string $email): string;
}
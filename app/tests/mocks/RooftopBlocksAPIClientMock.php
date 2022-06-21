<?php
namespace app\tests\mocks;

use app\infrastructure\api\RooftopBlocksAPIClientInterface;

class RooftopBlocksAPIClientMock implements RooftopBlocksAPIClientInterface
{
    private const orderedList = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"];
    private const unOrderedList =  ["1", "8", "7", "6", "5", "4", "3", "2", "10", "9"];
    private string $accessToken;
    
    public function getBlocks(string $accessToken): array
    {
        return self::unOrderedList;
    }

    public function isNext(string $accessToken, string $base, string $nextCandidate): bool
    {
        return (int) $nextCandidate === (int) $base + 1;
    }

    public function check(string $accessToken, array $blocks): bool
    {
        return $blocks === self::orderedList;
    }

    public function fetchAccessToken(string $email): string
    {
        return 'token';
    }
}

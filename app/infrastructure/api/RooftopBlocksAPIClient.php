<?php
namespace app\infrastructure\api;

use Assert\Assert;
use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Psr7\Utils;

class RooftopBlocksAPIClient implements RooftopBlocksAPIClientInterface
{
    private const ENDPOINT_FETCH_TOKEN = '/token';
    private const ENDPOINT_FETCH_BLOCKS = '/blocks';
    private const ENDPOINT_CHECK = '/check';
    
    public function __construct(
        private ClientInterface $client,
        private HttpFactory $factory,
    ) {
    }

    public function getBlocks(string $accessToken): array
    {
        $request = $this->factory->createRequest(
            'GET',
            $this->generateEndpointUrlWithAccessToken(self::ENDPOINT_FETCH_BLOCKS, $accessToken)
        );
        
        $result = $this->fetchJsonResult($request);
        
        if (empty($result['data'])) {
            throw new \Exception('Invalid response, no block data received');
        }
        
        Assert::that($result['data'])->all()->string('Invalid block details on block list');
        
        return $result['data'];
    }

    public function isNext(string $accessToken, string $base, string $nextCandidate): bool
    {
        $request = $this->factory->createRequest(
            'POST',
            $this->generateEndpointUrlWithAccessToken(self::ENDPOINT_CHECK, $accessToken),
        );
        
        $encodedBody = json_encode([
            'blocks' => [$base, $nextCandidate]
        ]);
        
        $request = $request
            ->withHeader('Content-Type', 'application/json')
            ->withBody(Utils::streamFor($encodedBody));
        
        $result = $this->fetchJsonResult($request);

        if (! isset($result['message'])) {
            throw new \Exception('Invalid response, no block data received');
        }
        
        return (bool) $result['message'];
    }

    public function check(string $accessToken, array $blocks): bool
    {
        $request = $this->factory->createRequest(
            'POST',
            $this->generateEndpointUrlWithAccessToken(self::ENDPOINT_CHECK, $accessToken),
        );

        $encodedBody = json_encode([
            'encoded' => implode('', $blocks)
        ]);

        $request = $request
            ->withHeader('Content-Type', 'application/json')
            ->withBody(Utils::streamFor($encodedBody));

        $result = $this->fetchJsonResult($request);

        if (! isset($result['message'])) {
            throw new \Exception('Invalid response, no block data received');
        }

        return (bool) $result['message'];
    }

    public function fetchAccessToken(string $email): string
    {
        $request = $this->factory->createRequest(
            'GET',
            self::ENDPOINT_FETCH_TOKEN . '?email=' . $email
        );

        $result = $this->fetchJsonResult($request);

        Assert::that($result['token'])->string('Invalid block details on block list');

        return $result['token'];
    }

    private function generateEndpointUrlWithAccessToken(string $endpointPath, string $accessToken): string
    {
        return $endpointPath . '?token=' . $accessToken;
    }

    private function fetchJsonResult(RequestInterface $request): array
    {
        $result = $this->client->sendRequest($request);
        
        if ($result->getStatusCode() != 200) {
            throw new \Exception('Invalid response code from server');
        }
        
        return json_decode((string) $result->getBody(), true);
    }
}

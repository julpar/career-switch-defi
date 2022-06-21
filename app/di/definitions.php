<?php
declare(strict_types=1);

use app\infrastructure\api\RooftopBlocksAPIClient;
use app\infrastructure\api\RooftopBlocksAPIClientInterface;
use GuzzleHttp\Client;

return [
    Psr\Http\Client\ClientInterface::class => DI\autowire(Client::class)
        ->constructorParameter('config', ['base_uri' =>  DI\env('API_ENDPOINT_BASE_URL')]),
    RooftopBlocksAPIClientInterface::class => DI\autowire(RooftopBlocksAPIClient::class),
    'api.auth.email' => DI\env('API_AUTH_EMAIL'),
];

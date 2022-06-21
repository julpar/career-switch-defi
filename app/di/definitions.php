<?php
declare(strict_types=1);

use app\infrastructure\api\RooftopBlocksAPIClientInterface;
use app\infrastructure\api\RooftopBlocksAPIInterface;
use app\infrastructure\api\RooftopBlocksAPIManager;
use app\tests\mocks\RooftopBlocksAPIClientMock;
use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Message\RequestFactoryInterface;

return [
    RooftopBlocksAPIInterface::class => DI\autowire(RooftopBlocksAPIManager::class),
    RequestFactoryInterface::class => DI\autowire(HttpFactory::class),
    RooftopBlocksAPIClientInterface::class => DI\autowire(RooftopBlocksAPIClientMock::class),
    'api.auth.email' => DI\env('API_AUTH_EMAIL')
];

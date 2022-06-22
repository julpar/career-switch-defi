<?php
declare(strict_types=1);

use app\di\Container;
use app\domain\blocks\BlocksManager;
use app\infrastructure\api\RooftopBlocksAPIClientInterface;

require __DIR__ . '/app/config/bootstrap.php';

/**
 * Order block array based on proposed api endpoints
 * @param string[] $blocks
 * @param string $token
 * @return string[] ordered blocks
 */
function check($blocks = [], $token = ''): array
{
    /** @var BlocksManager $app */
    $app = Container::getInstance()->get(BlocksManager::class);
    
    $app->setAccessToken($token);
    
    return $app->sort($blocks);
}

/** @var  RooftopBlocksAPIClientInterface  $client */
$client = Container::getInstance()->get(RooftopBlocksAPIClientInterface::class);
/** @var BlocksManager $app */
$app = Container::getInstance()->get(BlocksManager::class);

$accessToken = $client->fetchAccessToken(Container::getInstance()->get('api.auth.email'));

$sorted = check($client->getBlocks($accessToken), $accessToken);
    
if ($app->check($sorted)) {
    echo "Lo resolviste correctamente!";
} else {
    echo "Todavía puedes intentarlo!";
}

echo "\n";

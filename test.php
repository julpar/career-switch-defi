<?php
declare(strict_types=1);

use app\di\Container;
use app\domain\blocks\BlocksManager;
use app\infrastructure\api\RooftopBlocksAPIClientInterface;

require __DIR__ . '/app/config/bootstrap.php';

function check($blocks = [], $token = '')
{
    /** @var BlocksManager $app */
    $app = Container::getInstance()->get(BlocksManager::class);
    
    $app->setAccessToken($token);
    $sorted =  $app->sort($blocks);
    
    return $app->check($sorted);
}

/** @var  RooftopBlocksAPIClientInterface  $client */
$client = Container::getInstance()->get(RooftopBlocksAPIClientInterface::class);
$accessToken = $client->fetchAccessToken(Container::getInstance()->get('api.auth.email'));

if (check($client->getBlocks($accessToken), $accessToken)) {
    echo "Lo resolviste correctamente!";
} else {
    echo "Todavía puedes intentarlo!";
}

echo "\n";

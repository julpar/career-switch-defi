<?php
use app\di\Container;
use app\domain\blocks\BlocksManager;

require __DIR__ . '/app/config/bootstrap.php';

$container = Container::getInstance();

/** @var BlocksManager $app */
$app = $container->get(BlocksManager::class);

$blocks = $app->getBlocks();
$sortedBlocks = $app->sort($blocks);

if ($app->check($sortedBlocks)) {
    echo "Lo resolviste correctamente!";
} else {
    echo "Todavía puedes intentarlo!";
}

echo "\n";
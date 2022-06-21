<?php

namespace app\di;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

final class Container extends ContainerBuilder
{
    /**
     * @var ?ContainerInterface
     */
    private static $instance = null;
    
    public function __construct()
    {
        parent::__construct();

        $this->useAutowiring(true)
            ->addDefinitions(__DIR__ . '/definitions.php')
            ->writeProxiesToFile(true, __DIR__ . '/../tmp/proxies');
    }

    public static function getInstance(): ContainerInterface
    {
        if (static::$instance) {
            return static::$instance;
        }
        
        $builder = new static();
        static::$instance = $builder->build();
        
        return static::$instance;
    }
}

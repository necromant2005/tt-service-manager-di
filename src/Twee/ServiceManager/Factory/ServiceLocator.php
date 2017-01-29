<?php

namespace Twee\ServiceManager\Factory;

use Interop\Container\ContainerInterface;

class ServiceLocator
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        return new $requestedName($container);
    }
}
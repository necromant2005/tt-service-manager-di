<?php

namespace Twee\ServiceManager\Factory;

use Interop\Container\ContainerInterface;

class DependencyInjection
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        return (new Factory())->__invoke($container, $requestedName);
    }
}
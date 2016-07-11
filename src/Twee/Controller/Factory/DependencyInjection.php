<?php

namespace Twee\Controller\Factory;

use Twee\ServiceManager\Container\VersionTrait as ContainerVersionTrait;
use Twee\ServiceManager\Factory\DependencyInjection as FactoryDependencyInjection;
use Zend\ServiceManager\ServiceLocatorInterface;

class DependencyInjection
{
    use ContainerVersionTrait;

    public function __invoke(ServiceLocatorInterface $serviceLocator, $requestedName)
    {
        return (new FactoryDependencyInjection())->__invoke($serviceLocator, $requestedName, $requestedName);
    }
}
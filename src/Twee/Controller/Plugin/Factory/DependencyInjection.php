<?php

namespace Twee\Controller\Plugin\Factory;

use Twee\ServiceManager\Container\VersionTrait as ContainerVersionTrait;
use Twee\ServiceManager\Factory\DependencyInjection as FactoryDependencyInjection;
use Zend\ServiceManager\ServiceLocatorInterface;

class DependencyInjection
{
    use ContainerVersionTrait;

    public function __invoke(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return (new FactoryDependencyInjection())->__invoke($this->getContainer($serviceLocator), $name, $requestedName);
    }
}
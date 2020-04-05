<?php

namespace Twee\ServiceManager\Factory\View\Helper;

use Twee\ServiceManager\Factory\ServiceLocator as FactoryServiceLocator;
use Laminas\ServiceManager\ServiceLocatorInterface;

class ServiceLocator
{
    public function __invoke(ServiceLocatorInterface $serviceLocator, $requestedName)
    {
        return (new FactoryServiceLocator())->__invoke($serviceLocator, $requestedName);
    }
}

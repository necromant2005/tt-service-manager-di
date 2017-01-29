<?php

namespace Twee\ServiceManager\Factory\Controller;

use Twee\ServiceManager\Factory\ServiceLocator as FactoryServiceLocator;
use Zend\ServiceManager\ServiceLocatorInterface;

class ServiceLocator
{
    public function __invoke(ServiceLocatorInterface $serviceLocator, $requestedName)
    {
        return (new FactoryServiceLocator())->__invoke($serviceLocator, $requestedName);
    }
}
<?php

namespace Twee\View\Helper\Factory;

use Twee\ServiceManager\Factory\ServiceLocator as FactoryServiceLocator;
use Zend\ServiceManager\ServiceLocatorInterface;

class ServiceLocator
{
    public function __invoke(ServiceLocatorInterface $serviceLocator, $requestedName)
    {
        return (new FactoryServiceLocator())->__invoke($serviceLocator, $requestedName);
    }
}
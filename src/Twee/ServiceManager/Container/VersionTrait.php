<?php

namespace Twee\ServiceManager\Container;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

trait VersionTrait
{
    /**
     * @codeCoverageIgnore
     */
    public function getContainer(ServiceLocatorInterface $serviceLocator)
    {
        if ($serviceLocator instanceof AbstractPluginManager) {
            return $serviceLocator->getServiceLocator();
        }

        return $serviceLocator;
    }
}
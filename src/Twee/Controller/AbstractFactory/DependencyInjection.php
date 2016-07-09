<?php

namespace Twee\Controller\AbstractFactory;

use Interop\Container\ContainerInterface;
use Twee\ServiceManager\Factory\Factory;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DependencyInjection implements AbstractFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        return class_exists($requestedName, true);
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return (new Factory())->__invoke($container, $requestedName, $options);
    }

    /**
     * {@inheritdoc}
     *
     * @LEGACY zf2
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return class_exists($requestedName, true);
    }

    /**
     * {@inheritdoc}
     *
     * @LEGACY zf2
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $container = $serviceLocator->getServiceLocator();

        return (new Factory())->__invoke($container, $requestedName);
    }
}
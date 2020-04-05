<?php

namespace Twee\ServiceManager\Factory\Controller;

use Interop\Container\ContainerInterface;
use Twee\ServiceManager\Factory\Factory;
use Laminas\ServiceManager\Factory\AbstractFactoryInterface;

class AbstractFactoryController implements AbstractFactoryInterface
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
}

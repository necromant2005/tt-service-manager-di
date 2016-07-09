<?php

namespace Twee\ServiceManager\Factory;

use Interop\Container\ContainerInterface;

class Factory
{
    const INJECTIONS = 'injections';
    const PARAMETERS = 'parameters';

    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config')['di']['instance'];
        if (!array_key_exists($requestedName, $config)) {
            return new $requestedName();
        }
        $args = [];
        if (array_key_exists(self::INJECTIONS, $config[$requestedName])) {
            foreach ($config[$requestedName][self::INJECTIONS] as $injectionName) {
                $args[] = $container->get($injectionName);
            }
        }
        if (array_key_exists(self::PARAMETERS, $config[$requestedName])) {
            foreach ($config[$requestedName][self::PARAMETERS] as $parameterValue) {
                $args[] = $parameterValue;
            }
        }

        return new $requestedName(...$args);
    }
}
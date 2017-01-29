<?php

namespace Twee\ServiceManager\Factory\View\Helper;

use Test\Framework\Environment\Stub\ServiceManager\ServiceManager;
use Test\Framework\TestCase\TestCase;

class DependencyInjectionTest extends TestCase
{
    public function test()
    {
        $container = new ServiceManager();
        $container->set('Test\Framework\Environment\Stub\ServiceManager\ServiceManager', $container);
        $container->set('config', [
            'di' => [
                'instance' => [
                    'Twee\ServiceManager\Factory\Controller\AbstractControllerTest\ConstructMock' => [
                        'injections' => [
                            'Test\Framework\Environment\Stub\ServiceManager\ServiceManager',
                        ],
                        'parameters' => [
                            'my-custom-param' => 'abc',
                        ],
                    ],
                ],
            ],
        ]);

        $factory = new DependencyInjection();
        $instance = $factory->__invoke($container, 'Twee\ServiceManager\Factory\Controller\AbstractControllerTest\ConstructMock');
        $this->assertEquals([$container, 'abc'], $instance->getVars());
    }
}
<?php

namespace Twee\ServiceManager\Factory\Controller;

use Test\Framework\Environment\Stub\ServiceManager\ServiceManager;
use Test\Framework\TestCase\Controller as TestCaseController;

require_once __DIR__ . '/_files/AbstractControllerTest/ConstructMock.php';

class AbstractFactoryControllerTest extends TestCaseController
{
    public function testCanCreate()
    {
        $factory = new AbstractFactoryController();
        $this->assertTrue($factory->canCreate(new ServiceManager(), __CLASS__));
        $this->assertFalse($factory->canCreate(new ServiceManager(), 'NonExistsClass'));
    }

    public function testInvoke()
    {
        $container = new ServiceManager();
        $container->set('Test\Framework\Environment\Stub\ServiceManager\ServiceManager', $container);
        $container->set('config', [
            'di' => [
                'instance' => [
                ],
            ],
        ]);

        $factory = new AbstractFactoryController();
        $instance = $factory->__invoke($container, 'Twee\ServiceManager\Factory\Controller\AbstractControllerTest\ConstructMock');
        $this->assertEquals([], $instance->getVars());
    }

    public function testCreateInjectionsAndParameters()
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

        $factory = new AbstractFactoryController();
        $instance = $factory->__invoke($container, 'Twee\ServiceManager\Factory\Controller\AbstractControllerTest\ConstructMock');
        $this->assertEquals([$container, 'abc'], $instance->getVars());
    }
}
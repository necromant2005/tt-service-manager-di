<?php

namespace Twee\Controller\AbstractFactory;

use Twee\Controller\AbstractFactory\DependencyInjection as AbstractFactoryController;
use Test\Framework\Environment\Stub\Mvc\Controller\PluginManager;
use Test\Framework\Environment\Stub\ServiceManager\ServiceManager;
use Test\Framework\TestCase\Controller as TestCaseController;

require_once __DIR__ . '/_files/DependencyInjectionTest/ConstructMock.php';

class DependencyInjectionTest extends TestCaseController
{
    public function testCan()
    {
        $plugin = new PluginManager();
        $plugin->injectServiceLocator(new ServiceManager());

        $factory = new AbstractFactoryController();
        $this->assertTrue($factory->canCreate($plugin, __CLASS__));
        $this->assertFalse($factory->canCreate($plugin, 'NonExistsClass'));

        $this->assertTrue($factory->canCreateServiceWithName($plugin, __CLASS__, __CLASS__));
        $this->assertFalse($factory->canCreateServiceWithName($plugin, 'NonExistsClass', 'NonExistsClass'));
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
        $instance = $factory->__invoke($container, 'Twee\Controller\AbstractFactory\DependencyInjectionTest\ConstructMock');
        $this->assertEquals([], $instance->getVars());
    }

    // legacy
    public function testCreate()
    {
        $plugin = new PluginManager();
        $plugin->injectServiceLocator(new ServiceManager());
        $plugin->getServiceLocator()->set('Test\Framework\Environment\Stub\ServiceManager\ServiceManager', $plugin->getServiceLocator());
        $plugin->getServiceLocator()->set('config', [
            'di' => [
                'instance' => [
                ],
            ],
        ]);

        $factory = new AbstractFactoryController();
        $instance = $factory->createServiceWithName($plugin, 'ConstructMock', 'Twee\Controller\AbstractFactory\DependencyInjectionTest\ConstructMock');
        $this->assertEquals([], $instance->getVars());
    }

    public function testCreateInjectionsAndParameters()
    {
        $plugin = new PluginManager();
        $plugin->injectServiceLocator(new ServiceManager());
        $plugin->getServiceLocator()->set('Test\Framework\Environment\Stub\ServiceManager\ServiceManager', $plugin->getServiceLocator());
        $plugin->getServiceLocator()->set('config', [
            'di' => [
                'instance' => [
                    'Twee\Controller\AbstractFactory\DependencyInjectionTest\ConstructMock' => [
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
        $instance = $factory->createServiceWithName($plugin, 'ConstructMock', 'Twee\Controller\AbstractFactory\DependencyInjectionTest\ConstructMock');
        $this->assertEquals([$plugin->getServiceLocator(), 'abc'], $instance->getVars());
    }
}
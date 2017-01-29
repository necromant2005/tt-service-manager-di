<?php

namespace Twee\ServiceManager\Factory;

use Test\Framework\Environment\Stub\ServiceManager\ServiceManager;
use Test\Framework\TestCase\Controller as TestCaseController;

require_once __DIR__ . '/Controller/_files/AbstractControllerTest/ConstructMock.php';

class ServiceLocatorTest extends TestCaseController
{
    public function test()
    {
        $container = new ServiceManager();

        $factory = new ServiceLocator();
        $instance = $factory->__invoke($container, 'Twee\ServiceManager\Factory\Controller\AbstractControllerTest\ConstructMock');
        $this->assertEquals([$container], $instance->getVars());
    }
}
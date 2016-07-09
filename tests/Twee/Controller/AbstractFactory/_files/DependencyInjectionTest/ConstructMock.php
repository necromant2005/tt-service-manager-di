<?php

namespace Twee\Controller\AbstractFactory\DependencyInjectionTest;

class ConstructMock
{
    private $vars = [];

    public function __construct()
    {
        $this->vars = func_get_args();
    }

    public function getVars()
    {
        return $this->vars;
    }
}
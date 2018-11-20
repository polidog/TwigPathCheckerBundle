<?php

namespace Polidog\TwigPathCheckerBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver as BaseControllerResolver;

class ControllerResolver extends BaseControllerResolver
{
    public function openCreateController($controller)
    {
        return $this->createController($controller);
    }
}

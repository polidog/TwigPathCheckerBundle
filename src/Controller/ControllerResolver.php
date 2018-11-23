<?php declare(strict_types=1);

namespace Polidog\TwigPathCheckerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver as BaseControllerResolver;

class ControllerResolver extends BaseControllerResolver
{
    public function openCreateController($controller): callable
    {
        return $this->createController($controller);
    }
}

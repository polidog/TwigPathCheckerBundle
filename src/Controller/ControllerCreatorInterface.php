<?php declare(strict_types=1);

namespace Polidog\TwigPathCheckerBundle\Controller;

interface ControllerCreatorInterface
{
    public function create(string $name): callable;
}

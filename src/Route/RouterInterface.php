<?php declare(strict_types=1);

namespace Polidog\TwigPathCheckerBundle\Route;

interface RouterInterface
{
    /**
     * @return RouteInterface[]
     */
    public function getRoutes(): \Generator;
}

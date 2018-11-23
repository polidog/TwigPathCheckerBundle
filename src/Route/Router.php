<?php declare(strict_types=1);

namespace Polidog\TwigPathCheckerBundle\Route;

use Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser;

class Router implements RouterInterface
{
    /**
     * @var \Symfony\Component\Routing\Router
     */
    private $baseRouter;

    /**
     * @var ControllerNameParser
     */
    private $controllerNameParser;

    /**
     * Router constructor.
     *
     * @param \Symfony\Component\Routing\Router $baseRouter
     */
    public function __construct(\Symfony\Component\Routing\Router $baseRouter)
    {
        $this->baseRouter = $baseRouter;
    }

    public function getRoutes(): \Generator
    {
        foreach ($this->baseRouter->getRouteCollection() as $route) {
            if ($route->hasDefault('_controller')) {
                yield $this->controllerNameParser->build($route->getDefault('_controller'));
            }
        }
    }
}

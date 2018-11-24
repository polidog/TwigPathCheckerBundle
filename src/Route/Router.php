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
     * @param \Symfony\Component\Routing\Router $baseRouter
     * @param ControllerNameParser $controllerNameParser
     */
    public function __construct(\Symfony\Component\Routing\Router $baseRouter, ControllerNameParser $controllerNameParser)
    {
        $this->baseRouter = $baseRouter;
        $this->controllerNameParser = $controllerNameParser;
    }

    public function getRoutes(): \Generator
    {
        foreach ($this->baseRouter->getRouteCollection() as $route) {
            if ($route->hasDefault('_controller')) {
                try {
                    yield $this->controllerNameParser->build($route->getDefault('_controller'));
                } catch (\InvalidArgumentException $e) {
                    continue;
                }
            }
        }
    }
}

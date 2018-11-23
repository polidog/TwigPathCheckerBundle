<?php declare(strict_types=1);

namespace Polidog\TwigPathCheckerBundle\Controller;

class ControllerCreator implements ControllerCreatorInterface
{
    /**
     * @var ControllerResolver
     */
    private $controllerResolver;

    /**
     * ControllerCreator constructor.
     *
     * @param ControllerResolver $controllerResolver
     */
    public function __construct(ControllerResolver $controllerResolver)
    {
        $this->controllerResolver = $controllerResolver;
    }

    /**
     * @param string $name
     *
     * @return callable
     */
    public function create(string $name): callable
    {
        return $this->controllerResolver->openCreateController($name);
    }
}

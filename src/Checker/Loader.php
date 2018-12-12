<?php

namespace Polidog\TwigPathCheckerBundle\Checker;


class Loader
{
    /**
     * @var \Twig_Loader_Filesystem
     */
    private $twigLoader;

    /**
     * Loader constructor.
     * @param \Twig_Loader_Filesystem $twigLoader
     */
    public function __construct(\Twig_Loader_Filesystem $twigLoader)
    {
        $this->twigLoader = $twigLoader;
    }

    public function exists($name)
    {
        return $this->twigLoader->exists($name);
    }

    /**
     * @throws \ReflectionException
     */
    public function findTemplate($name)
    {
       $ref = new \ReflectionMethod($this->twigLoader, 'findTemplate');
       $ref->setAccessible(true);
       return $ref->invoke($name);
    }

}

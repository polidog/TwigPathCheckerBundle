<?php

namespace Polidog\TwigPathCheckerBundle\Checker;

class TwigExistChecker
{
    /**
     * @var \Twig_Loader_Filesystem
     */
    private $loader;

    /**
     * TwigExistChecker constructor.
     * @param \Twig_Loader_Filesystem $loader
     */
    public function __construct(\Twig_Loader_Filesystem $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @param string $templateName
     * @return bool
     */
    public function check($templateName)
    {
        return $this->loader->exists($templateName);
    }
}

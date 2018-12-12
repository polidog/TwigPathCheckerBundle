<?php

namespace Polidog\TwigPathCheckerBundle\Checker;

class TwigExistChecker
{
    /**
     * @var Loader
     */
    private $loader;

    /**
     * TwigExistChecker constructor.
     * @param \Twig_Loader_Filesystem $loader
     */
    public function __construct(Loader $loader)
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

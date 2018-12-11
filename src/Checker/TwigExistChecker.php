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
     * @param Loader $loader
     */
    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @param string $templateName
     * @return bool
     */
    public function check(string $templateName)
    {
        return $this->loader->exists($templateName);
    }
}

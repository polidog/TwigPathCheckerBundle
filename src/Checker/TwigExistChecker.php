<?php

namespace Polidog\TwigPathCheckerBundle\Checker;


class TwigExistChecker
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * TwigExistChecker constructor.
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }


    public function check(string $templateName) : bool
    {
        try {
            $this->twig->load($templateName);
            return true;
        } catch (\Twig_Error_Loader $e) {
            return false;
        }
    }
}

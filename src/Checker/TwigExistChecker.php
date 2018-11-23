<?php declare(strict_types=1);

namespace Polidog\TwigPathCheckerBundle\Checker;

class TwigExistChecker
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * TwigExistChecker constructor.
     *
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param string $templateName
     *
     * @return bool
     *
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function check(string $templateName): bool
    {
        try {
            $this->twig->load($templateName);

            return true;
        } catch (\Twig_Error_Loader $e) {
            return false;
        }
    }
}

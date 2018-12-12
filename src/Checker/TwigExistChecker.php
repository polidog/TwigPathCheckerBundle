<?php

namespace Polidog\TwigPathCheckerBundle\Checker;


use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;

class TwigExistChecker
{
    /**
     * @var FilesystemLoader
     */
    private $loader;

    /**
     * TwigExistChecker constructor.
     * @param FilesystemLoader $loader
     */
    public function __construct(FilesystemLoader $loader)
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

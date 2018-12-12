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
        if ($this->loader->exists($templateName)) {
            return file_exists($this->getRealPath($templateName));
        }
        return false;
    }

    /**
     * @param $templateName
     * @return mixed
     * @throws \ReflectionException
     */
    public function getRealPath($templateName)
    {
        $ref = new \ReflectionMethod($this->loader, 'findTemplate');
        $ref->setAccessible(true);
        return $ref->invokeArgs($this->loader, [$templateName]);

    }
}

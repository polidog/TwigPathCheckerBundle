<?php

namespace Polidog\TwigPathCheckerBundle\Checker;


use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;

class Loader extends FilesystemLoader
{
    public function exists($name)
    {
        return parent::exists($name);
    }

    public function getTemplatePath($name)
    {
        return $this->findTemplate($name);
    }
}


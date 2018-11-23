<?php declare(strict_types=1);

namespace Polidog\TwigPathCheckerBundle\Template;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

interface AnnotationParserInterface
{
    /**
     * @param array $controller
     *
     * @return Template[]
     */
    public function parse(array $controller): array;
}

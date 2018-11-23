<?php declare(strict_types=1);

namespace Polidog\TwigPathCheckerBundle\Finder;

use Polidog\TwigPathCheckerBundle\Template\AnnotationParserInterface;
use Polidog\TwigPathCheckerBundle\Controller\ControllerCreatorInterface;
use Polidog\TwigPathCheckerBundle\Route\RouterInterface;

class TemplateFinder implements FinderInterface
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var ControllerCreatorInterface
     */
    private $controllerCreator;

    /**
     * @var AnnotationParserInterface
     */
    private $annotationParser;

    public function find(): \Generator
    {
        foreach ($this->router->getRoutes() as $name) {
            $controller = $this->controllerCreator->create($name);
            $templatePaths = $this->annotationParser->parse($this->annotationParser->parse($controller));
            if (\count($templatePaths) > 0) {
                yield [
                    'name' => $name,
                    'controller' => $controller,
                    'templatePaths' => $templatePaths,
                ];
            }
        }
    }
}

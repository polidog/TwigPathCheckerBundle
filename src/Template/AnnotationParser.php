<?php declare(strict_types=1);

namespace Polidog\TwigPathCheckerBundle\Template;

use Doctrine\Common\Annotations\Reader;
use Polidog\TwigPathCheckerBundle\Controller\ControllerResolver;
use ReflectionClass;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Templating\TemplateGuesser;

class AnnotationParser implements AnnotationParserInterface
{
    /**
     * @var ControllerResolver
     */
    private $controllerResolver;

    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var TemplateGuesser
     */
    private $templateGuesser;

    /**
     * AnnotationParser constructor.
     *
     * @param ControllerResolver $controllerResolver
     * @param Reader             $reader
     * @param TemplateGuesser    $templateGuesser
     */
    public function __construct(ControllerResolver $controllerResolver, Reader $reader, TemplateGuesser $templateGuesser)
    {
        $this->controllerResolver = $controllerResolver;
        $this->reader = $reader;
        $this->templateGuesser = $templateGuesser;
    }

    /**
     * @param array $controller
     *
     * @return array
     *
     * @throws \ReflectionException
     */
    public function parse(array $controller): array
    {
        $className = class_exists('Doctrine\Common\Util\ClassUtils') ? ClassUtils::getClass($controller[0]) : \get_class($controller[0]);
        $object = new ReflectionClass($className);
        $method = $object->getMethod($controller[1]);
        $templatePaths = [];

        foreach ($this->reader->getMethodAnnotations($method) as $template) {
            if ($template instanceof Template) {
                if ($template->getTemplate()) {
                    $templatePaths[$template->getTemplate()] = $template->getTemplate();
                } else {
                    $path = $this->templateGuesser->guessTemplateName($controller, $request);
                    if ($path) {
                        $templatePaths[$path] = $path;
                    }
                }
            }
        }

        return $templatePaths;
    }
}

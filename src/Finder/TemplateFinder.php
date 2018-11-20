<?php

namespace Polidog\TwigPathCheckerBundle\Finder;


use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Util\ClassUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Templating\TemplateGuesser;
use Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\RouterInterface;
use Polidog\TwigPathCheckerBundle\Controller\ControllerResolver;
use ReflectionClass;

class TemplateFinder
{
    /**
     * @var RouterInterface
     */
    private $router;

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
     * TemplateFinder constructor.
     * @param RouterInterface $router
     * @param ControllerResolver $controllerResolver
     * @param Reader $reader
     * @param TemplateGuesser $templateGuesser
     */
    public function __construct(RouterInterface $router, ControllerResolver $controllerResolver, Reader $reader, TemplateGuesser $templateGuesser)
    {
        $this->router = $router;
        $this->controllerResolver = $controllerResolver;
        $this->reader = $reader;
        $this->templateGuesser = $templateGuesser;
    }

    public function run(KernelInterface $kernel):\Generator
    {

        foreach ($this->router->getRouteCollection() as $route) {
            if ($route->hasDefault('_controller')) {
                $nameParser = new ControllerNameParser($kernel);
                try {
                    $name = $nameParser->build($route->getDefault('_controller'));
                    $controller = $this->controllerResolver->openCreateController($name);
                    $templates = $this->checkAnnotation($controller);

                    $request = new Request();
                    $request->setFormat('html',['text/html']);

                    $templatePaths = [];

                    /** @var Template $template */
                    foreach ($templates as $template) {
                        if ($template->getTemplate()) {
                            $templatePaths[$template->getTemplate()] = $template->getTemplate();
                        } else {
                            $path = $this->templateGuesser->guessTemplateName($controller, $request);
                            if ($path) {
                                $templatePaths[$path] = $path;
                            }
                        }
                    }

                    if (\count($templatePaths) > 0) {
                        yield [
                            'name' => $name,
                            'controller' => $controller,
                            'templatePaths' => $templatePaths
                        ];
                    }

                } catch (\InvalidArgumentException $e) {
                    continue;
                } catch (\ReflectionException $re) {
                    continue;
                }
            }
        }
    }

    /**
     * @param array $controller
     * @return array
     * @throws \ReflectionException
     */
    private function checkAnnotation(array $controller) :array
    {
        $className = class_exists('Doctrine\Common\Util\ClassUtils') ? ClassUtils::getClass($controller[0]) : \get_class($controller[0]);
        $object = new ReflectionClass($className);
        $method = $object->getMethod($controller[1]);

        $annotations = [];
        foreach ($this->reader->getMethodAnnotations($method) as $annotation) {
            if ($annotation instanceof Template) {
                $annotations[] = $annotation;
            }
        }
        return $annotations;
    }
}

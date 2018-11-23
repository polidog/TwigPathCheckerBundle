<?php declare(strict_types=1);

namespace Polidog\TwigPathCheckerBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Polidog\TwigPathCheckerBundle\Checker\TwigExistChecker;
use Polidog\TwigPathCheckerBundle\Finder\TemplateFinder;

class CheckerCommand extends Command
{
    /**
     * @var TemplateFinder
     */
    private $templateFinder;

    /**
     * @var TwigExistChecker
     */
    private $checker;

    /**
     * CheckerCommand constructor.
     *
     * @param TemplateFinder   $controllerFinder
     * @param TwigExistChecker $twigExistChecker
     */
    public function __construct(TemplateFinder $controllerFinder, TwigExistChecker $twigExistChecker)
    {
        parent::__construct();
        $this->templateFinder = $controllerFinder;
        $this->checker = $twigExistChecker;
    }

    protected function configure(): void
    {
        $this->setName('lint:twig:path');
    }

    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $exitStatus = 0;
        foreach ($this->templateFinder->find() as $data) {
            foreach ($data['templatePaths'] as $templatePath) {
                if (false === $this->checker->check($templatePath)) {
                    $exitStatus = 1;
                    $output->writeln("<error>[ERROR]</error> Unable to find template: ${templatePath}, Contrlller: ${data['name']}");
                }
            }
        }


//
//        foreach ($this->templateFinder->run($this->getApplication()->getKernel()) as $data) {
//            foreach ($data['templatePaths'] as $templatePath) {
//                if (false === $this->checker->check($templatePath)) {
//                    $exitStatus = 1;
//                    $output->writeln("<error>[ERROR]</error> Unable to find template: ${templatePath}, Contrlller: ${data['name']}");
//                }
//            }
//        }
        exit($exitStatus);
    }
}

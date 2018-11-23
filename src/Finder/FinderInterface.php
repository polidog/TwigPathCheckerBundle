<?php declare(strict_types=1);

namespace Polidog\TwigPathCheckerBundle\Finder;

interface FinderInterface
{
    public function find(): \Generator;
}

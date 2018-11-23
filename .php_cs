
<?php
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__."/src")
//    ->in(__DIR__."/tests")
;
return \PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony:risky' => true,
        '@PHP71Migration:risky' => true,
        'array_syntax' => ['syntax' => 'short']
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
    ->setLineEnding("\n")
    ;

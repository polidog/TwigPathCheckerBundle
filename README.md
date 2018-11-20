# polidog/twig-path-checker-bundle

This bundle is check tiwg file path.

## install

```
$ composer require --dev polidog/twig-path-checker-bundle
```

## Configuration

```
// AppKernel.php
public function registerBundles()
{
    $bundles = array(
        // ...
        new Polidog\TwigPathCheckerBUndle\PolidogTwigPathCheckerBUndle(),
        // ...
    );
}
```


## Using

```
$ bin/console lint:twig:path
```

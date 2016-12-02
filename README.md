symfony3-test-task-azovsky-bundle
=====================

## Install Symfony3 if need

<a href="http://symfony.com/doc/current/setup.html">Installing & Setting up the Symfony Framework</a>

## Install bundle via Composer

In composer.json
```json
{
    "repositories": [
        {
            "type": "vcs",
            "url":  "https://github.com/miviskin/symfony3-test-task-azovsky-bundle.git"
        }
    ],
    "require": {
        "miviskin/symfony3-test-task-azovsky-bundle": "dev-master"
    }
}
```

Update composer

```shell
$ composer update
```

## Enable the bundle

```php
// in app/AppKernel.php
public function registerBundles()
{
    $bundles = [
        // ...
        new Miviskin\AzovskyBundle\MiviskinAzovskyBundle(),     
    ];
    // ...
}
```

## Routing

Prepend into app/config/routing.yml
```yaml
miviskin_azovsky:
    resource: "@MiviskinAzovskyBundle/Controller/"
    type:     annotation
    prefix:   /
```

## Configuration

In app/config/config.yml
```yaml
imports:
    ...
    - { resource: "@MiviskinAzovskyBundle/Resources/config/services.yml" }
    
parameters:
    ...
    miviskin_azovsky.sources:
        - \Miviskin\AzovskyBundle\Sources\CbrSource
        - \Miviskin\AzovskyBundle\Sources\YahooSource
```

## Start dev server

```shell
$ php bin/console server:run
```

open URL <a href="http://localhost:8000/rate" target="_blank">http://localhost:8000/rate</a>

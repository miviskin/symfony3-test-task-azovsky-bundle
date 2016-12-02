symfony3-test-task-azovsky-bundle
=====================

## Install via Composer

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

open URL [http://localhost:8000/rate](http://localhost:8000/rate)

symfony3-test-task-azovsky-bundle
=====================

```shell
$ composer install
```

```shell
$ php bin/console server:run
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

In app/config/routing.yml
```yaml
miviskin_azovsky:
    resource: "@MiviskinAzovskyBundle/Controller/"
    type:     annotation
    prefix:   /
```

In app/config/config.yml
```yaml
imports:
    ...
    - { resource: "@MiviskinAzovskyBundle/Resources/config/services.yml" }
    
parameters:
    ...
    miviskin_azovsky.sources:
        - "\\Miviskin\AzovskyBundle\\Sources\\CbrSource"
        - "\\Miviskin\AzovskyBundle\\Sources\\YahooSource"
```

open url http://localhost:8000/rate

# Container Interop Service Provider for Zend Diactoros

Provides
[container-interop/service-provider](https://github.com/container-interop/service-provider)
support for [zendframework/zend-diactoros](https://github.com/zendframework/zend-diactoros).

## Installation

```sh
$ composer require bnf/zend-diactoros-service-provider:~0.4.0
```

## Usage

Add `Bnf\ZendDiactoros\ServiceProvider` to the list of service providers to register the PSR-17 factories.

Specify it prior to your own service providers to be able to overwrite or extend the factories.

```php
new Container([
    new \Bnf\ZendDiactoros\ServiceProvider,
    new YouServiceProvider,
]);
```

## Example

Example usage with a `container-interop/service-provider` compatible container `bnf/di`.

```sh
$ composer require bnf/zend-diactoros-service-provider:~0.4.0 bnf/di:~0.1.0 zendframework/zend-diactoros:^2.0
```

```php
<?php
declare(strict_types = 1);
require 'vendor/autoload.php';

use Bnf\Di\Container;
use Bnf\ZendDiactoros\ServiceProvider as ZendDiactorosServiceProvider;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Interop\Container\ServiceProviderInterface;

class Service
{
    private $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function create404Response()
    {
        $this->responseFactory->createResponse(404);
    }
}

$container = new Container([
    new ZendDiactorosServiceProvider,

    // Register own services and configuration
    new class implements ServiceProviderInterface {
        public function getFactories(): array
        {
            return [
                Service::class => function (ContainerInterface $container): Service {
                    return new Service($container->get(ResponseFactoryInterface::class));
                }
            ];
        }
        public function getExtensions(): array
        {
            return [];
        }
    }
]);

$service = $container->get(Service::class);
var_dump($service->create404Response());
```

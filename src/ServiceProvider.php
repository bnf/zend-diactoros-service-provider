<?php
declare(strict_types = 1);
namespace Bnf\ZendDiactoros;

use Interop\Container\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Zend\Diactoros\ResponseFactory;
use Zend\Diactoros\RequestFactory;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\StreamFactory;
use Zend\Diactoros\UploadedFileFactory;
use Zend\Diactoros\UriFactory;

class ServiceProvider implements ServiceProviderInterface
{
    public function getFactories(): array
    {
        return [
            ResponseFactory::class => [ self::class, 'getResponseFactory' ],
            RequestFactory::class => [ self::class, 'getRequestFactory' ],
            ServerRequestFactory::class => [ self::class, 'getServerRequestFactory' ],
            StreamFactory::class => [ self::class, 'getStreamFactory' ],
            UploadedFileFactory::class => [ self::class, 'getUploadedFileFactory' ],
            UriFactory::class => [ self::class, 'getUriFactory' ],

            ResponseFactoryInterface::class => [ self::class, 'getResponseFactoryImplementation' ],
            RequestFactoryInterface::class => [ self::class, 'getRequestFactoryImplementation' ],
            ServerRequestFactoryInterface::class => [ self::class, 'getServerRequestFactoryImplementation' ],
            StreamFactoryInterface::class => [ self::class, 'getStreamFactoryImplementation' ],
            UploadedFileFactoryInterface::class => [ self::class, 'getUploadedFileFactoryImplementation' ],
            UriFactoryInterface::class => [ self::class, 'getUriFactoryImplementation' ],
        ];
    }

    public function getExtensions(): array
    {
        return [];
    }

    public static function getResponseFactory(): ResponseFactory
    {
        return new ResponseFactory;
    }

    public static function getRequestFactory(): RequestFactory
    {
        return new RequestFactory;
    }

    public static function getServerRequestFactory(): ServerRequestFactory
    {
        return new ServerRequestFactory;
    }

    public static function getStreamFactory(): StreamFactory
    {
        return new StreamFactory;
    }

    public static function getUploadedFileFactory(): UploadedFileFactory
    {
        return new UploadedFileFactory;
    }

    public static function getUriFactory(): UriFactory
    {
        return new UriFactory;
    }

    public static function getResponseFactoryImplementation(ContainerInterface $c): ResponseFactoryInterface
    {
        return $c->get(ResponseFactory::class);
    }

    public static function getRequestFactoryImplementation(ContainerInterface $c): RequestFactoryInterface
    {
        return $c->get(RequestFactory::class);
    }

    public static function getServerRequestFactoryImplementation(ContainerInterface $c): ServerRequestFactoryInterface
    {
        return $c->get(ServerRequestFactory::class);
    }

    public static function getStreamFactoryImplementation(ContainerInterface $c): StreamFactoryInterface
    {
        return $c->get(StreamFactory::class);
    }

    public static function getUploadedFileFactoryImplementation(ContainerInterface $c): UploadedFileFactoryInterface
    {
        return $c->get(UploadedFileFactory::class);
    }

    public static function getUriFactoryImplementation(ContainerInterface $c): UriFactoryInterface
    {
        return $c->get(UriFactory::class);
    }
}

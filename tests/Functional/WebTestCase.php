<?php

namespace Test\Functional;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Psr7\Factory\StreamFactory;

class WebTestCase extends TestCase
{
    public static function json($method, $uri, $body = []): RequestInterface
    {
        $request = self::request($method, $uri)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'application/json')
            ->withBody((new StreamFactory())->createStream(json_encode($body, JSON_THROW_ON_ERROR)));

        return $request;
    }
    private static function request(string $method, $uri): ServerRequestInterface
    {
        return (new ServerRequestFactory())->createServerRequest($method, $uri);
    }
    public function app(): App
    {
        $container = $this->container();
        return (require __DIR__ . '/../../config/app.php')($container);

    }

    private function container(): ContainerInterface
    {
        return require(__DIR__ . '/../../config/container.php');
    }
}

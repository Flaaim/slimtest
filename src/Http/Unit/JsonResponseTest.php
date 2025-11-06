<?php

namespace App\Http\Unit;

use App\Http\JsonResponse;
use PHPUnit\Framework\TestCase;

class JsonResponseTest extends TestCase
{
    public function testCode(): void
    {
        $response = new JsonResponse(0, 201);
        self::assertEquals(201, $response->getStatusCode());
        self::assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        self::assertEquals(0, $response->getBody()->getContents());
    }

    public function testNull(): void
    {
        $response = new JsonResponse(null);
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('null', $response->getBody()->getContents());
    }

    public function testInt(): void
    {
        $response = new JsonResponse(12);
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('12', $response->getBody()->getContents());
    }

    public function testString(): void
    {
        $response = new JsonResponse('12');
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('"12"', $response->getBody()->getContents());
    }

    public function testObject(): void
    {
        $class = new \stdClass();
        $class->str = 'bar';
        $class->int = 12;
        $class->none = null;
        $response = new JsonResponse($class, 200);
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('{"str":"bar","int":12,"none":null}', $response->getBody()->getContents());
    }

    public function testArray(): void
    {
        $array = ['str' => 'bar', 'int' => 12, 'none' => null];
        $response = new JsonResponse($array, 200);
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('{"str":"bar","int":12,"none":null}', $response->getBody()->getContents());
    }
}

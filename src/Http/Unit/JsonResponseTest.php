<?php

namespace App\Http\Unit;

use App\Http\JsonResponse;
use PHPUnit\Framework\Attributes\DataProvider;
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

    #[DataProvider('getCases')]
    public function testResponse($source, $expected): void
    {
        $response = new JsonResponse($source, 200);
        self::assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        self::assertEquals($expected, $response->getBody()->getContents());
        self::assertEquals(200, $response->getStatusCode());
    }
    public static function getCases(): array
    {
        $class = new \stdClass();
        $class->str = 'bar';
        $class->int = 12;
        $class->none = null;

        $array = ['str' => 'bar', 'int' => 12, 'none' => null];

        return [
            'null' => [null, 'null'],
            'empty' => ['', '""'],
            'string' => ['12', '"12"'],
            'object' => [$class, '{"str":"bar","int":12,"none":null}'],
            'array' => [$array, '{"str":"bar","int":12,"none":null}'],
        ];
    }
}

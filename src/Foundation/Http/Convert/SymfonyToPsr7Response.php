<?php

namespace Ody\Core\Foundation\Http\Convert;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\ServerRequestFactory as Psr17Factory;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Factory\UploadedFileFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class SymfonyToPsr7Response
{
    public function handle(SymfonyResponse $response): ResponseInterface
    {
        $psrHttpFactory = new PsrHttpFactory(
            new Psr17Factory(),
            new StreamFactory(),
            new UploadedFileFactory(),
            new ResponseFactory()
        );

        return $psrHttpFactory->createResponse($response);
    }
}
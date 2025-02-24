<?php

namespace Ody\Core\Http\Convert;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Factory\UploadedFileFactory;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\ServerRequestFactory as Psr17Factory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

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
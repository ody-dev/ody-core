<?php
declare(strict_types=1);
namespace Ody\Core\Http\Convert;

use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;

class Psr7ToSymfonyRequest
{
    public function handle(ServerRequestInterface $request): Request
    {
        $httpFoundationFactory = new HttpFoundationFactory();

        return $httpFoundationFactory->createRequest($request);
    }
}
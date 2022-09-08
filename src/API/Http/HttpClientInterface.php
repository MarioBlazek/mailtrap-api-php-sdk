<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Http;

interface HttpClientInterface
{
    public function get(string $uri): HttpResponseInterface;

    /**
     * @param array<mixed> $body
     */
    public function post(string $uri, array $body = []): HttpResponseInterface;

    /**
     * @param array<mixed> $body
     */
    public function patch(string $uri, array $body = []): HttpResponseInterface;

    public function delete(string $uri): HttpResponseInterface;
}

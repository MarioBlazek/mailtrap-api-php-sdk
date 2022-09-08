<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Http;

interface HttpClientInterface
{
    public function get(string $uri): array;
    public function post(string $uri, array $body = []): array;
    public function patch(string $uri, array $body = []): array;
    public function delete(string $uri): array;
}
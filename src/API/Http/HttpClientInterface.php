<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Http;

use Marek\Mailtrap\API\Exception\Network\APIException;

interface HttpClientInterface
{
    /**
     * @throws APIException
     */
    public function get(string $uri): HttpResponseInterface;

    /**
     * @param array<mixed> $body
     *
     * @throws APIException
     */
    public function post(string $uri, array $body = []): HttpResponseInterface;

    /**
     * @param array<mixed> $body
     *
     * @throws APIException
     */
    public function patch(string $uri, array $body = []): HttpResponseInterface;

    /**
     * @throws APIException
     */
    public function delete(string $uri): HttpResponseInterface;
}

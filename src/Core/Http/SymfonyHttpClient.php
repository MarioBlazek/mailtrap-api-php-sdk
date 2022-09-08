<?php

declare(strict_types=1);

namespace Marek\Mailtrap\Core\Http;

use Marek\Mailtrap\API\Exception\Network\BadRequestException;
use Marek\Mailtrap\API\Exception\Network\BaseException;
use Marek\Mailtrap\API\Exception\Network\ConflictException;
use Marek\Mailtrap\API\Exception\Network\ForbiddenException;
use Marek\Mailtrap\API\Exception\Network\MethodNotAllowedException;
use Marek\Mailtrap\API\Exception\Network\NetworkException;
use Marek\Mailtrap\API\Exception\Network\NotAcceptableException;
use Marek\Mailtrap\API\Exception\Network\NotFoundException;
use Marek\Mailtrap\API\Exception\Network\TooManyRequestsException;
use Marek\Mailtrap\API\Exception\Network\UnauthorizedException;
use Marek\Mailtrap\API\Exception\Network\UnprocessableEntityException;
use Marek\Mailtrap\API\Http\HttpClientInterface;
use Marek\Mailtrap\API\Value\Authentication\ApiToken;
use Marek\Mailtrap\API\Value\BaseUrl;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface as SymfonyHttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class SymfonyHttpClient implements HttpClientInterface
{
    private SymfonyHttpClientInterface $httpClient;
    private ApiToken $apiToken;
    private BaseUrl $baseUrl;

    public function __construct(SymfonyHttpClientInterface $httpClient, ApiToken $apiToken, BaseUrl $baseUrl)
    {
        $this->httpClient = $httpClient;
        $this->apiToken = $apiToken;
        $this->baseUrl = $baseUrl;
    }

    public function get(string $uri): array
    {
        return $this->doRequest('GET', $uri);
    }

    /**
     * @throws BaseException
     * @throws \JsonException
     */
    public function post(string $uri, array $body = []): array
    {
        return $this->doRequest('POST', $uri, $body);
    }

    public function patch(string $uri, array $body = []): array
    {
        return $this->doRequest('PATCH', $uri, $body);
    }

    public function delete(string $uri): array
    {
        return $this->doRequest('DELETE', $uri);
    }

    private function getUrl(string $uri): string
    {
        return sprintf("%s%s", $this->baseUrl, $uri);
    }

    /**
     * @throws \JsonException
     * @throws BaseException
     */
    private function doRequest(string $method, string $uri, array $body = []): array
    {
        $options = [
            'headers' => [
                'Api-Token' => (string)$this->apiToken,
                'Content-Type' => 'application/json'
            ],
        ];

        if (count($body) > 0) {
            $options['body'] = json_encode($body, JSON_THROW_ON_ERROR);
        }

        $response = $this->httpClient->request(
            $method,
            $this->getUrl($uri),
            $options
        );

        $this->checkResponseAndThrowIfNecessary($response);

        return json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws BaseException
     */
    private function checkResponseAndThrowIfNecessary(ResponseInterface $response): void
    {
        try {
            $statusCode = $response->getStatusCode();
        } catch (ExceptionInterface $exception) {
            throw new NetworkException($exception->getMessage());
        }

        if (in_array($statusCode, [200, 201, 204], true)) {
            return;
        }

        switch ($statusCode) {
            case 400:
                throw new BadRequestException();
            case 401:
                throw new UnauthorizedException();
            case 403:
                throw new ForbiddenException();
            case 404:
                throw new NotFoundException();
            case 405:
                throw new MethodNotAllowedException();
            case 406:
                throw new NotAcceptableException();
            case 409:
                throw new ConflictException();
            case 422:
                throw new UnprocessableEntityException();
            case 429:
                throw new TooManyRequestsException();
            default:
                throw new NetworkException();
        }
    }
}
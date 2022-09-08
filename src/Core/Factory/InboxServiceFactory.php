<?php

declare(strict_types=1);

namespace Marek\Mailtrap\Core\Factory;

use Marek\Mailtrap\API\InboxService as APIService;
use Marek\Mailtrap\API\Value\Authentication\ApiToken;
use Marek\Mailtrap\API\Value\BaseUrl;
use Marek\Mailtrap\Core\Http\SymfonyHttpClient;
use Marek\Mailtrap\Core\InboxService;
use Symfony\Component\HttpClient\HttpClient;

final class InboxServiceFactory
{
    public static function create(string $token, string $baseUrl = 'https://mailtrap.io'): APIService
    {
        $apiToken = new ApiToken($token);
        $url = new BaseUrl($baseUrl);
        $symfonyHttpClient = HttpClient::create();
        $serializer = SerializerFactory::create();
        $httpClient = new SymfonyHttpClient($symfonyHttpClient, $apiToken, $url);

        return new InboxService($httpClient, $serializer);
    }
}
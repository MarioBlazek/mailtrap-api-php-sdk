<?php

declare(strict_types=1);

namespace Marek\Mailtrap\Core\Http;

use Marek\Mailtrap\API\Exception\Serializer\ResponseCantBeDeserializedException;
use Marek\Mailtrap\API\Http\HttpResponseInterface;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use JsonException;
use function json_decode;

final class SymfonyResponse implements HttpResponseInterface
{
    /**
     * @var mixed[]
     */
    private array $content;
    private int $statusCode;

    /**
     * @param array<mixed> $content
     */
    public function __construct(array $content, int $statusCode)
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
    }

    /**
     * @throws ResponseCantBeDeserializedException
     */
    public static function createFromSymfonyResponse(ResponseInterface $response): self
    {
        try {
            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (ExceptionInterface $exception) {
            return new self([], 0);
        } catch (JsonException $exception) {
            throw new ResponseCantBeDeserializedException();
        }

        return new self($content, $statusCode);
    }

    /**
     * @return mixed[]
     */
    public function getContent(): array
    {
        return $this->content;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
<?php

declare(strict_types=1);

namespace Marek\Mailtrap\Tests\Functional\Mock;

use Marek\Mailtrap\API\Http\HttpResponseInterface;

final class ResponseMock implements HttpResponseInterface
{
    private array $content;
    private int $statusCode;

    public function __construct(array $content, int $statusCode)
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
    }

    public static function createFromFile(string $filename, int $statusCode): self
    {
        $content = json_decode(file_get_contents($filename), true, 512, JSON_THROW_ON_ERROR);

        return new self($content, $statusCode);
    }

    /**
     * @inheritDoc
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

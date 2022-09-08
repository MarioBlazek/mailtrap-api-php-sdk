<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Value;

use Assert\Assert;

final class BaseUrl
{
    private string $url;

    public function __construct(string $url)
    {
        Assert::that($url)->url();
        $this->url = $url;
    }

    public function __toString(): string
    {
        return $this->url;
    }

    public static function createFromString(string $url): self
    {
        return new self($url);
    }
}

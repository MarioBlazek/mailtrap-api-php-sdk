<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Value\Request;

use Assert\Assert;

final class InboxName
{
    private string $name;

    public function __construct(string $name)
    {
        Assert::that($name)->minLength(1);
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
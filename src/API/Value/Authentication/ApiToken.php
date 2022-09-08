<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Value\Authentication;

use Assert\Assert;

final class ApiToken
{
    private string $token;

    public function __construct(string $token)
    {
        Assert::lazy()->that($token)->minLength(5);
        $this->token = $token;
    }

    public function __toString(): string
    {
        return $this->token;
    }
}

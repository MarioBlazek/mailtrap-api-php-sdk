<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Exception\Network;

use Throwable;

final class UnauthorizedException extends APIException
{
    public function __construct(string $message = "Authentication failed or user doesn't have permissions for requested operation", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Exception\Network;

use Throwable;

final class ConflictException extends BaseException
{
    public function __construct(string $message = "Request could not be completed due to a conflict with the current state of the target resource", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
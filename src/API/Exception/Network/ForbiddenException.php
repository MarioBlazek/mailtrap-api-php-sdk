<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Exception\Network;

use Throwable;

final class ForbiddenException extends BaseException
{
    public function __construct($message = "Access denied", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
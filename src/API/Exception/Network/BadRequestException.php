<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Exception\Network;

use Throwable;

final class BadRequestException extends BaseException
{
    public function __construct($message = "The request could not be understood or was missing required parameters", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
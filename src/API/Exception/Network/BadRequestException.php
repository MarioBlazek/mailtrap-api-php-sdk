<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Exception\Network;

use Throwable;

final class BadRequestException extends BaseException
{
    public function __construct(string $message = 'The request could not be understood or was missing required parameters', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

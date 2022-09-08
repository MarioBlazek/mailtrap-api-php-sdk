<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Exception\Network;

use Throwable;

final class TooManyRequestsException extends BaseException
{
    public function __construct(string $message = 'Exceeded Mailtrap API limits. Pause requests, wait up to one minute, and try again', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

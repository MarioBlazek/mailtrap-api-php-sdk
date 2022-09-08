<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Exception\Network;

use Throwable;

final class NotAcceptableException extends BaseException
{
    public function __construct($message = "The target resource does not have a current representation that would be acceptable to the user agent, according to the proactive negotiation header fields received in the request", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Exception\Network;

use Throwable;

final class UnprocessableEntityException extends BaseException
{
    public function __construct($message = "Requested data contain invalid values", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Exception\Network;

use Throwable;

final class MethodNotAllowedException extends BaseException
{
    public function __construct($message = "Requested method is not supported for resource", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
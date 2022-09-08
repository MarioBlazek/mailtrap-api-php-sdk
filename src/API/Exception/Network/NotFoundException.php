<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Exception\Network;

use Throwable;

final class NotFoundException extends BaseException
{
    public function __construct($message = "Resource was not found", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
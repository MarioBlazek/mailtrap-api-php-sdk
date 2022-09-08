<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Http;

interface HttpResponseInterface
{
    /**
     * @return mixed[]
     */
    public function getContent(): array;

    public function getStatusCode(): int;
}
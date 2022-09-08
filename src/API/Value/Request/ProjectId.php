<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Value\Request;

use Assert\Assert;

final class ProjectId
{
    private int $id;

    public function __construct(int $id)
    {
        Assert::that($id)->greaterThan(0);
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Value\Request;

use Assert\Assert;

final class UpdateProject
{
    private string $name;
    private ProjectId $projectId;

    public function __construct(ProjectId $projectId, string $name)
    {
        Assert::that($name)->minLength(1);
        $this->name = $name;
        $this->projectId = $projectId;
    }

    public function getProjectId(): ProjectId
    {
        return $this->projectId;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
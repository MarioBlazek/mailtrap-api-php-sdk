<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Marek\Mailtrap\API\Exception\Project\ProjectNotFoundException;
use Marek\Mailtrap\API\Value\Request\ProjectId;
use Marek\Mailtrap\Core\Factory\ProjectServiceFactory;

$projectService = ProjectServiceFactory::create(
    \file_get_contents(__DIR__ . '/../api_token'),
);

$projectId = new ProjectId(1383273);

try {
    $projectService->deleteProject($projectId);

    echo "Project removed successfully\n";
} catch (ProjectNotFoundException $exception) {
    echo "Not found\n";
}

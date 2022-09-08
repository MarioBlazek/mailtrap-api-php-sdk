<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Marek\Mailtrap\Core\Factory\ProjectServiceFactory;
use Marek\Mailtrap\API\Exception\Serializer\ResponseCantBeDeserializedException;

$projectService = ProjectServiceFactory::create(
    file_get_contents(__DIR__ . '/../api_token')
);

try {
    $projects = $projectService->getProjects();

    foreach ($projects as $project) {
        echo "Project name: $project->id\n";
        echo "Project name: $project->name\n";
        echo "Project inboxes count: $project->inboxCount\n";
        echo "-----------------------------\n";
    }
} catch (ResponseCantBeDeserializedException $e) {
    echo "Error";
}

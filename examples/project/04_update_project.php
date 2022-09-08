<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Marek\Mailtrap\Core\Factory\ProjectServiceFactory;
use Marek\Mailtrap\API\Value\Request\ProjectId;
use Marek\Mailtrap\API\Value\Request\UpdateProject;
use Marek\Mailtrap\API\Exception\Project\ProjectNotFoundException;
use Faker\Factory;

$projectService = ProjectServiceFactory::create(
    file_get_contents(__DIR__ . '/../api_token')
);

$faker = Factory::create();
$projectId = new ProjectId(1383226);
$updateProject = new UpdateProject($projectId, $faker->company);

try {
    $project = $projectService->updateProject($updateProject);
    $inboxes = count($project->inboxes);

    echo "Project #$project->id \n";
    echo "Name: $project->name \n";
    echo "Inboxes: $inboxes \n";
    foreach ($project->inboxes as $key => $inbox) {
        echo "Inbox #$key -> name $inbox->name\n";
    }
} catch (ProjectNotFoundException $exception) {
    echo "Not found\n";
}

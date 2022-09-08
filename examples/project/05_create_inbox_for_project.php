<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Marek\Mailtrap\Core\Factory\ProjectServiceFactory;
use Marek\Mailtrap\API\Value\Request\ProjectId;
use Marek\Mailtrap\API\Exception\Project\ProjectNotFoundException;
use Marek\Mailtrap\API\Value\Request\InboxName;
use Faker\Factory;

$projectService = ProjectServiceFactory::create(
    file_get_contents(__DIR__ . '/../api_token')
);

$faker = Factory::create();
$projectId = new ProjectId(1023568);

try {
    $inbox = $projectService->createInboxForProject($projectId, new InboxName($faker->company));

    echo "Inbox #$inbox->id\n";
    echo "Inbox name $inbox->name\n";
} catch (ProjectNotFoundException $exception) {
    echo "Not found\n";
}



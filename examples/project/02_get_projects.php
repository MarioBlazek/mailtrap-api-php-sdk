<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Marek\Mailtrap\API\Exception\Serializer\ResponseCantBeDeserializedException;
use Marek\Mailtrap\API\Value\Request\AccountId;
use Marek\Mailtrap\Core\Factory\ProjectServiceFactory;

$token = \file_get_contents(__DIR__ . '/../api_token');
$token = \trim(\preg_replace('/\s+/', ' ', $token));

$projectService = ProjectServiceFactory::create($token);

try {
    $accountId = new AccountId(989208);

    $projects = $projectService->getProjects($accountId);

    foreach ($projects as $project) {
        echo "Project name: {$project->id}\n";
        echo "Project name: {$project->name}\n";
        echo "Project inboxes count: {$project->getInboxCount()}\n";
        echo "-----------------------------\n";
    }
} catch (ResponseCantBeDeserializedException $e) {
    echo 'Error';
}

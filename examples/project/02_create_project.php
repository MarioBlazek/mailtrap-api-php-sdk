<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Marek\Mailtrap\Core\Factory\ProjectServiceFactory;
use Marek\Mailtrap\API\Value\Request\CreateProject;
use Faker\Factory;

$projectService = ProjectServiceFactory::create(
    file_get_contents(__DIR__ . '/../api_token')
);

$faker = Factory::create();
$createProject = new CreateProject($faker->company);
$project = $projectService->createProject($createProject);

echo "Newly created project: \n";
echo "Name: $project->id\n";
echo "Name: $project->name\n";

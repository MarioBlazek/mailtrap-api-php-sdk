<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API;

use Marek\Mailtrap\API\Exception\Network\APIException;
use Marek\Mailtrap\API\Exception\Project\ProjectNotFoundException;
use Marek\Mailtrap\API\Value\Request\CreateProject;
use Marek\Mailtrap\API\Value\Request\InboxName;
use Marek\Mailtrap\API\Value\Request\ProjectId;
use Marek\Mailtrap\API\Value\Request\UpdateProject;
use Marek\Mailtrap\API\Value\Response\Inbox;
use Marek\Mailtrap\API\Value\Response\Project;
use Marek\Mailtrap\API\Value\Response\Projects;

interface ProjectService
{
    /**
     * Get a list of projects (companies) and inboxes.
     *
     * @throws APIException
     */
    public function getProjects(): Projects;

    /**
     * Create a project (company).
     *
     * @throws APIException
     */
    public function createProject(CreateProject $createProject): Project;

    /**
     * Get project (company) and inboxes.
     *
     * @throws ProjectNotFoundException
     * @throws APIException
     */
    public function getProject(ProjectId $projectId): Project;

    /**
     * Update project (company).
     *
     * @throws ProjectNotFoundException
     * @throws APIException
     */
    public function updateProject(UpdateProject $updateProject): Project;

    /**
     * Delete project (company) (only if you are the owner of the project, "is_owner: true").
     *
     * @throws ProjectNotFoundException
     * @throws APIException
     */
    public function deleteProject(ProjectId $projectId): void;

    /**
     * Create inbox in the project (company).
     *
     * @throws ProjectNotFoundException
     * @throws APIException
     */
    public function createInboxForProject(ProjectId $projectId, InboxName $inboxName): Inbox;
}

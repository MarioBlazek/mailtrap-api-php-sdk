<?php

declare(strict_types=1);

namespace Marek\Mailtrap\Core;

use Marek\Mailtrap\API\Exception\Network\NotFoundException;
use Marek\Mailtrap\API\Exception\Project\ProjectNotFoundException;
use Marek\Mailtrap\API\Exception\Serializer\ResponseCantBeDeserializedException;
use Marek\Mailtrap\API\Http\HttpResponseInterface;
use Marek\Mailtrap\API\Value\Request\InboxName;
use Marek\Mailtrap\API\Value\Request\CreateProject;
use Marek\Mailtrap\API\Value\Request\ProjectId;
use Marek\Mailtrap\API\Value\Request\UpdateProject;
use Marek\Mailtrap\API\Value\Response\Inbox;
use Marek\Mailtrap\API\Value\Response\Project;
use Marek\Mailtrap\API\Value\Response\Projects;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Marek\Mailtrap\API\Http\HttpClientInterface;
use Marek\Mailtrap\API\ProjectService as APIProjectService;

final class ProjectService implements APIProjectService
{
    private const URI_PROJECTS = '/api/v1/companies';
    private const URI_PROJECT = '/api/v1/companies/project_id';
    private const URI_PROJECT_INBOXES = '/api/v1/companies/project_id/inboxes';

    private HttpClientInterface $client;
    private DenormalizerInterface $serializer;

    public function __construct(HttpClientInterface $client, DenormalizerInterface $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    /**
     * @throws ResponseCantBeDeserializedException
     */
    public function getProjects(): Projects
    {
        $response = $this->client->get(self::URI_PROJECTS);

        $projects = [];
        foreach ($response->getContent() as $item) {
            $projects[] = $this->denormalizeProject($item);
        }

        return new Projects($projects);
    }

    /**
     * @throws ResponseCantBeDeserializedException
     */
    public function createProject(CreateProject $createProject): Project
    {
        $response = $this->client->post(self::URI_PROJECTS, [
            'company' => [
                'name' => (string)$createProject,
            ]
        ]);

        return $this->denormalizeProject($response);
    }

    /**
     * @throws ResponseCantBeDeserializedException|ProjectNotFoundException
     */
    public function getProject(ProjectId $projectId): Project
    {
        $uri = str_replace('project_id', (string)$projectId->getId(), self::URI_PROJECT);

        try {
            $response = $this->client->get($uri);
        } catch (NotFoundException $exception) {
            throw new ProjectNotFoundException($exception->getMessage());
        }

        return $this->denormalizeProject($response);
    }

    /**
     * @throws ResponseCantBeDeserializedException
     * @throws ProjectNotFoundException
     */
    public function updateProject(UpdateProject $updateProject): Project
    {
        $uri = str_replace('project_id', (string)$updateProject->getProjectId()->getId(), self::URI_PROJECT);

        try {
            $response = $this->client->patch($uri, [
                'company' => [
                    'name' => $updateProject
                ]
            ]);
        } catch (NotFoundException $exception) {
            throw new ProjectNotFoundException($exception->getMessage());
        }

        return $this->denormalizeProject($response);
    }

    /**
     * @throws ProjectNotFoundException
     */
    public function deleteProject(ProjectId $projectId): void
    {
        $uri = str_replace('project_id', (string)$projectId->getId(), self::URI_PROJECT);

        try {
            $this->client->delete($uri);
        } catch (NotFoundException $exception) {
            throw new ProjectNotFoundException($exception->getMessage());
        }
    }

    /**
     * @throws ResponseCantBeDeserializedException
     * @throws ProjectNotFoundException
     */
    public function createInboxForProject(ProjectId $projectId, InboxName $inboxName): Inbox
    {
        $uri = str_replace('project_id', (string)$projectId->getId(), self::URI_PROJECT_INBOXES);

        try {
            $response = $this->client->post($uri, [
                'inbox' => [
                    'name' => (string)$inboxName
                ]
            ]);
        } catch (NotFoundException $exception) {
            throw new ProjectNotFoundException($exception->getMessage());
        }

        return $this->denormalizeInbox($response);
    }

    /**
     * @throws ResponseCantBeDeserializedException
     */
    private function denormalizeProject(HttpResponseInterface $response): Project
    {
        try {
            $project = $this->serializer->denormalize($response, Project::class);
        } catch (ExceptionInterface $exception) {
            throw new ResponseCantBeDeserializedException();
        }

        return $project;
    }

    /**
     * @throws ResponseCantBeDeserializedException
     */
    private function denormalizeInbox(HttpResponseInterface $response): Inbox
    {
        try {
            $inbox = $this->serializer->denormalize($response->getContent(), Inbox::class);
        } catch (ExceptionInterface $exception) {
            throw new ResponseCantBeDeserializedException();
        }

        return $inbox;
    }
}

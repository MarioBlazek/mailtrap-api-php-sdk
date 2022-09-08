<?php

declare(strict_types=1);

namespace Marek\Mailtrap\Core;

use Marek\Mailtrap\API\InboxService;
use Marek\Mailtrap\API\Mailtrap as APIMailtrap;
use Marek\Mailtrap\API\ProjectService;

final class Mailtrap implements APIMailtrap
{
    private ProjectService $projectService;
    private InboxService $inboxService;

    public function __construct(ProjectService $projectService, InboxService $inboxService)
    {
        $this->projectService = $projectService;
        $this->inboxService = $inboxService;
    }

    public function getInboxService(): InboxService
    {
        return $this->inboxService;
    }

    public function getProjectService(): ProjectService
    {
        return $this->projectService;
    }
}

<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API;

interface Mailtrap
{
    public function getInboxService(): InboxService;

    public function getProjectService(): ProjectService;
}

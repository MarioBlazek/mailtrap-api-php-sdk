<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Value\Response;

final class Project
{
    public int $id;
    public string $name;
    public bool $isOwner;
    public string $shareLink;
    public string $extId;

    /**
     * @var Inbox[]
     */
    public array $inboxes = [];
}

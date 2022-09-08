<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Value\Request;

final class UpdateInbox
{
    private InboxId $inboxId;
    private string $name;
    private ?string $emailUsername;

    public function __construct(InboxId $inboxId, string $name, ?string $emailUsername)
    {
        $this->inboxId = $inboxId;

        if ($name === '') {
            throw new \InvalidArgumentException();
        }

        if ($emailUsername === '') {
            throw new \InvalidArgumentException();
        }

        $this->name = $name;
        $this->emailUsername = $emailUsername;
    }

    public function getInboxId(): InboxId
    {
        return $this->inboxId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmailUsername(): ?string
    {
        return $this->emailUsername;
    }
}

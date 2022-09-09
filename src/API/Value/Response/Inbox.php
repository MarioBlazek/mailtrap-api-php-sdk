<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Value\Response;

use function end;
use function sprintf;

final class Inbox
{
    public int $id;
    public int $companyId;
    public string $name;
    public string $username;
    public string $password;
    public int $maxSize;
    public string $status;
    public string $emailUsername;
    public bool $emailUsernameEnabled;
    public int $sentMessagesCount;
    public int $forwardedMessagesCount;
    public bool $used;
    public string $forwardFromEmailAddress;
    public string $domain;
    public string $pop3Domain;
    public string $emailDomain;
    public int $emailsCount;
    public int $emailsUnreadCount;
    public ?string $lastMessageSentAt;
//    public ?\DateTimeImmutable $lastMessageSentAt;

    /**
     * @var array<int>
     */
    public array $smtpPorts = [];

    /**
     * @var  array<int>
     */
    public array $pop3Ports = [];
    public int $maxMessageSize;
    public bool $hasInboxAddress;

    public function getSmtpDsn(): string
    {
        return sprintf(
            'smtp://%s:%s@%s:%d?encryption=tls&auth_mode=login',
            $this->username,
            $this->password,
            $this->domain,
            end($this->smtpPorts),
        );
    }
}

<?php

declare(strict_types=1);

namespace Marek\Mailtrap\Tests\Functional\Core;

use Marek\Mailtrap\API\Exception\Network\NotFoundException;
use Marek\Mailtrap\API\Http\HttpClientInterface;
use Marek\Mailtrap\API\Value\Request\InboxId;
use Marek\Mailtrap\Core\Factory\SerializerFactory;
use Marek\Mailtrap\Core\InboxService;
use Marek\Mailtrap\API\InboxService as APIInboxService;
use Marek\Mailtrap\Tests\Functional\Mock\ResponseMock;
use PHPUnit\Framework\TestCase;

final class InboxServiceTest extends TestCase
{
    protected APIInboxService $inboxService;
    protected HttpClientInterface $httpClient;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(HttpClientInterface::class);
        $serializer = SerializerFactory::create();
        $this->inboxService = new InboxService($this->httpClient, $serializer);
    }

    public function testGetInbox(): void
    {
        $responseFile = __DIR__ . '/../Mock/inbox_response.json';
        $responseFileContent = json_decode(file_get_contents($responseFile), true, 512, JSON_THROW_ON_ERROR);

        $responseMock = ResponseMock::createFromFile($responseFile, 200);

        $this->httpClient->expects($this->once())
            ->method('get')
            ->willReturn($responseMock);

        $this->httpClient->expects($this->never())->method('post');
        $this->httpClient->expects($this->never())->method('patch');
        $this->httpClient->expects($this->never())->method('delete');

        $inboxId = new InboxId(1644767);

        $inbox = $this->inboxService->getInbox($inboxId);

        self::assertEquals($responseFileContent['id'], $inbox->id);
        self::assertEquals($responseFileContent['company_id'], $inbox->companyId);
        self::assertEquals($responseFileContent['name'], $inbox->name);
        self::assertEquals($responseFileContent['username'], $inbox->username);
        self::assertEquals($responseFileContent['password'], $inbox->password);
        self::assertEquals($responseFileContent['max_size'], $inbox->maxSize);
        self::assertEquals($responseFileContent['status'], $inbox->status);
        self::assertEquals($responseFileContent['email_username'], $inbox->emailUsername);
        self::assertEquals($responseFileContent['email_username_enabled'], $inbox->emailUsernameEnabled);
        self::assertEquals($responseFileContent['sent_messages_count'], $inbox->sentMessagesCount);
        self::assertEquals($responseFileContent['forwarded_messages_count'], $inbox->forwardedMessagesCount);
        self::assertEquals($responseFileContent['used'], $inbox->used);
        self::assertEquals($responseFileContent['forward_from_email_address'], $inbox->forwardFromEmailAddress);
        self::assertEquals($responseFileContent['domain'], $inbox->domain);
        self::assertEquals($responseFileContent['pop3_domain'], $inbox->pop3Domain);
        self::assertEquals($responseFileContent['email_domain'], $inbox->emailDomain);
        self::assertEquals($responseFileContent['emails_count'], $inbox->emailsCount);
        self::assertEquals($responseFileContent['emails_unread_count'], $inbox->emailsUnreadCount);
        self::assertEquals($responseFileContent['last_message_sent_at'], $inbox->lastMessageSentAt);
        self::assertEquals($responseFileContent['max_message_size'], $inbox->maxMessageSize);
        self::assertEquals($responseFileContent['has_inbox_address'], $inbox->hasInboxAddress);
        self::assertEquals($responseFileContent['smtp_ports'], $inbox->smtpPorts);
        self::assertEquals($responseFileContent['pop3_ports'], $inbox->pop3Ports);

    }

    public function testNotFound(): void
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('Resource was not found');

        $this->httpClient->expects($this->never())->method('post');
        $this->httpClient->expects($this->never())->method('patch');
        $this->httpClient->expects($this->never())->method('delete');

        $this->httpClient->expects($this->once())
            ->method('get')
            ->willThrowException(new NotFoundException());

        $inboxId = new InboxId(1644767);

        $this->inboxService->getInbox($inboxId);
    }
}

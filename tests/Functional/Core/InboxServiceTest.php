<?php

declare(strict_types=1);

namespace Marek\Mailtrap\Tests\Functional\Core;

use Marek\Mailtrap\API\Exception\Network\NotFoundException;
use Marek\Mailtrap\API\Http\HttpClientInterface;
use Marek\Mailtrap\API\InboxService as APIInboxService;
use Marek\Mailtrap\API\Value\Request\InboxId;
use Marek\Mailtrap\Core\Factory\SerializerFactory;
use Marek\Mailtrap\Core\InboxService;
use Marek\Mailtrap\Tests\Functional\Mock\ResponseMock;
use PHPUnit\Framework\TestCase;

use function file_get_contents;
use function json_decode;

use const JSON_THROW_ON_ERROR;

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

        $this->httpClient->expects(self::once())
            ->method('get')
            ->willReturn($responseMock);

        $this->httpClient->expects(self::never())->method('post');
        $this->httpClient->expects(self::never())->method('patch');
        $this->httpClient->expects(self::never())->method('delete');

        $inboxId = new InboxId(1644767);

        $inbox = $this->inboxService->getInbox($inboxId);

        self::assertSame($responseFileContent['id'], $inbox->id);
        self::assertSame($responseFileContent['company_id'], $inbox->companyId);
        self::assertSame($responseFileContent['name'], $inbox->name);
        self::assertSame($responseFileContent['username'], $inbox->username);
        self::assertSame($responseFileContent['password'], $inbox->password);
        self::assertSame($responseFileContent['max_size'], $inbox->maxSize);
        self::assertSame($responseFileContent['status'], $inbox->status);
        self::assertSame($responseFileContent['email_username'], $inbox->emailUsername);
        self::assertSame($responseFileContent['email_username_enabled'], $inbox->emailUsernameEnabled);
        self::assertSame($responseFileContent['sent_messages_count'], $inbox->sentMessagesCount);
        self::assertSame($responseFileContent['forwarded_messages_count'], $inbox->forwardedMessagesCount);
        self::assertSame($responseFileContent['used'], $inbox->used);
        self::assertSame($responseFileContent['forward_from_email_address'], $inbox->forwardFromEmailAddress);
        self::assertSame($responseFileContent['domain'], $inbox->domain);
        self::assertSame($responseFileContent['pop3_domain'], $inbox->pop3Domain);
        self::assertSame($responseFileContent['email_domain'], $inbox->emailDomain);
        self::assertSame($responseFileContent['emails_count'], $inbox->emailsCount);
        self::assertSame($responseFileContent['emails_unread_count'], $inbox->emailsUnreadCount);
        self::assertSame($responseFileContent['last_message_sent_at'], $inbox->lastMessageSentAt);
        self::assertSame($responseFileContent['max_message_size'], $inbox->maxMessageSize);
        self::assertSame($responseFileContent['has_inbox_address'], $inbox->hasInboxAddress);
        self::assertSame($responseFileContent['smtp_ports'], $inbox->smtpPorts);
        self::assertSame($responseFileContent['pop3_ports'], $inbox->pop3Ports);
    }

    public function testNotFound(): void
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('Resource was not found');

        $this->httpClient->expects(self::never())->method('post');
        $this->httpClient->expects(self::never())->method('patch');
        $this->httpClient->expects(self::never())->method('delete');

        $this->httpClient->expects(self::once())
            ->method('get')
            ->willThrowException(new NotFoundException());

        $inboxId = new InboxId(1644767);

        $this->inboxService->getInbox($inboxId);
    }
}

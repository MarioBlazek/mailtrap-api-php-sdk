<?php

declare(strict_types=1);

namespace Marek\Mailtrap\Core;

use Marek\Mailtrap\API\Exception\Inbox\InboxNotFoundException;
use Marek\Mailtrap\API\Exception\Network\NotFoundException;
use Marek\Mailtrap\API\Exception\Serializer\ResponseCantBeDeserializedException;
use Marek\Mailtrap\API\Http\HttpResponseInterface;
use Marek\Mailtrap\API\Value\Request\InboxId;
use Marek\Mailtrap\API\Value\Request\UpdateInbox;
use Marek\Mailtrap\API\Value\Response\Inbox;
use Marek\Mailtrap\API\Value\Response\Inboxes;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Marek\Mailtrap\API\Http\HttpClientInterface;
use Marek\Mailtrap\API\InboxService as APIInboxService;

final class InboxService implements APIInboxService
{
    private const URI_INBOXES = '/api/v1/inboxes';
    private const URI_INBOX = '/api/v1/inboxes/inbox_id';
    private const URI_INBOX_CLEAN = '/api/v1/inboxes/inbox_id/clean';
    private const URI_INBOX_ALL_READ = '/api/v1/inboxes/inbox_id/all_read';
    private const URI_INBOX_RESET_CREDENTIALS = '/api/v1/inboxes/inbox_id/reset_credentials';
    private const URI_INBOX_RESET_EMAIL_USERNAME = '/api/v1/inboxes/inbox_id/reset_email_username';
    private const URI_INBOX_TOGGLE_EMAIL_USERNAME = '/api/v1/inboxes/inbox_id/toggle_email_username';

    private HttpClientInterface $httpClient;
    private DenormalizerInterface $serializer;

    public function __construct(HttpClientInterface $httpClient, DenormalizerInterface $serializer)
    {
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
    }

    /**
     * @throws ResponseCantBeDeserializedException
     */
    public function getInboxes(): Inboxes
    {
        $response = $this->httpClient->get(self::URI_INBOXES);

        return $this->denormalizeInboxes($response);
    }

    /**
     * @throws ResponseCantBeDeserializedException
     */
    public function getInbox(InboxId $inboxId): Inbox
    {
        $uri = str_replace('inbox_id', (string)$inboxId->getId(), self::URI_INBOX);
        $response = $this->httpClient->get($uri);

        return $this->denormalizeInbox($response);
    }

    /**
     * @throws ResponseCantBeDeserializedException
     * @throws InboxNotFoundException
     */
    public function updateInbox(UpdateInbox $updateInbox): Inbox
    {
        $uri = str_replace('inbox_id', (string)$updateInbox->getInboxId()->getId(), self::URI_INBOX);
        $body = [
            'inbox' => [
                'name' => $updateInbox->getName(),
                'email_username' => $updateInbox->getEmailUsername() ?? '',
            ]
        ];

        try {
            $response = $this->httpClient->patch($uri, $body);
        } catch (NotFoundException $exception) {
            throw new InboxNotFoundException($exception->getMessage());
        }

        return $this->denormalizeInbox($response);
    }

    public function deleteInbox(InboxId $inboxId): void
    {
        $uri = str_replace('inbox_id', (string)$inboxId->getId(), self::URI_INBOX);

        try {
            $this->httpClient->delete($uri);
        } catch (NotFoundException $exception) {
            throw new InboxNotFoundException($exception->getMessage());
        }
    }

    /**
     * @throws ResponseCantBeDeserializedException
     * @throws InboxNotFoundException
     */
    public function clean(InboxId $inboxId): Inbox
    {
        return $this->patch(self::URI_INBOX_CLEAN, $inboxId);
    }

    /**
     * @throws ResponseCantBeDeserializedException
     * @throws InboxNotFoundException
     */
    public function markAllMessagesAsRead(InboxId $inboxId): Inbox
    {
        return $this->patch(self::URI_INBOX_ALL_READ, $inboxId);
    }

    /**
     * @throws ResponseCantBeDeserializedException
     * @throws InboxNotFoundException
     */
    public function resetCredentials(InboxId $inboxId): Inbox
    {
        return $this->patch(self::URI_INBOX_RESET_CREDENTIALS, $inboxId);
    }

    /**
     * @throws ResponseCantBeDeserializedException
     * @throws InboxNotFoundException
     */
    public function resetEmailUsername(InboxId $inboxId): Inbox
    {
        return $this->patch(self::URI_INBOX_RESET_EMAIL_USERNAME, $inboxId);
    }

    /**
     * @throws ResponseCantBeDeserializedException
     * @throws InboxNotFoundException
     */
    public function toggleEmailUsername(InboxId $inboxId): Inbox
    {
        return $this->patch(self::URI_INBOX_TOGGLE_EMAIL_USERNAME, $inboxId);
    }

    /**
     * @throws ResponseCantBeDeserializedException
     * @throws InboxNotFoundException
     */
    private function patch(string $uri, InboxId $inboxId): Inbox
    {
        $uri = str_replace('inbox_id', (string)$inboxId->getId(), $uri);

        try {
            $response = $this->httpClient->patch($uri);
        } catch (NotFoundException $exception) {
            throw new InboxNotFoundException($exception->getMessage());
        }

        return $this->denormalizeInbox($response);
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

    /**
     * @throws ResponseCantBeDeserializedException
     */
    private function denormalizeInboxes(HttpResponseInterface $response): Inboxes
    {
        $inboxes = [];

        try {
            foreach ($response->getContent() as $item) {
                $inboxes[] = $this->serializer->denormalize($item, Inbox::class);
            }
        } catch (ExceptionInterface $exception) {
            throw new ResponseCantBeDeserializedException();
        }

        return new Inboxes($inboxes);
    }
}

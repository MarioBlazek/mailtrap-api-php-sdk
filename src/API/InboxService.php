<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API;

use Marek\Mailtrap\API\Exception\Inbox\InboxNotFoundException;
use Marek\Mailtrap\API\Value\Request\InboxId;
use Marek\Mailtrap\API\Value\Request\UpdateInbox;
use Marek\Mailtrap\API\Value\Response\Inbox;
use Marek\Mailtrap\API\Value\Response\Inboxes;

interface InboxService
{
    /**
     * Get a list of inboxes
     */
    public function getInboxes(): Inboxes;

    /**
     * Get inbox
     *
     * @throws InboxNotFoundException
     */
    public function getInbox(InboxId $inboxId): Inbox;

    /**
     * Update inbox
     *
     * @throws InboxNotFoundException
     */
    public function updateInbox(UpdateInbox $updateInbox): Inbox;

    /**
     * Delete inbox
     *
     * @throws InboxNotFoundException
     */
    public function deleteInbox(InboxId $inboxId): void;

    /**
     * Delete all messages (emails) from inbox
     *
     * @throws InboxNotFoundException
     */
    public function clean(InboxId $inboxId): Inbox;

    /**
     * Mark all messages (emails) as read
     *
     * @throws InboxNotFoundException
     */
    public function markAllMessagesAsRead(InboxId $inboxId): Inbox;

    /**
     * Reset inbox credentials
     *
     * @throws InboxNotFoundException
     */
    public function resetCredentials(InboxId $inboxId): Inbox;

    /**
     * Reset inbox email address
     *
     * @throws InboxNotFoundException
     */
    public function resetEmailUsername(InboxId $inboxId): Inbox;

    /**
     * Enable/disable retrieval of messages in this inbox to the specified email address
     *
     * @throws InboxNotFoundException
     */
    public function toggleEmailUsername(InboxId $inboxId): Inbox;
}
<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Marek\Mailtrap\API\Value\Request\InboxId;
use Marek\Mailtrap\API\Exception\Inbox\InboxNotFoundException;
use Marek\Mailtrap\Core\Factory\InboxServiceFactory;

$inboxService = InboxServiceFactory::create(
    file_get_contents(__DIR__ . '/../api_token')
);

$inboxId = new InboxId(1644767);

try {
    $inbox = $inboxService->getInbox($inboxId);

    echo "Inbox $inbox->id\n";
    echo "Inbox name: $inbox->name\n";
} catch (InboxNotFoundException $exception) {
    echo "Inbox not found\n";
}

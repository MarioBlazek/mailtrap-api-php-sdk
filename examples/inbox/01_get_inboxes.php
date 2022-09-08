<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Marek\Mailtrap\API\Exception\Serializer\ResponseCantBeDeserializedException;
use Marek\Mailtrap\Core\Factory\InboxServiceFactory;

$inboxService = InboxServiceFactory::create(
    file_get_contents(__DIR__ . '/../api_token')
);

try {
    $inboxes = $inboxService->getInboxes();

    foreach ($inboxes as $inbox) {
        echo "Inbox #$inbox->id\n";
        echo "Inbox name: $inbox->name\n";
        echo "-----------------------------\n";
    }
} catch (ResponseCantBeDeserializedException $e) {
    echo "Error\n";
}

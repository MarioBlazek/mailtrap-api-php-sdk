<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Marek\Mailtrap\API\Exception\Inbox\InboxNotFoundException;
use Marek\Mailtrap\API\Value\Request\InboxId;
use Marek\Mailtrap\Core\Factory\InboxServiceFactory;

$inboxService = InboxServiceFactory::create(
    \file_get_contents(__DIR__ . '/../api_token'),
);

$inboxId = new InboxId(1883774);

try {
    $inbox = $inboxService->resetEmailUsername($inboxId);
} catch (InboxNotFoundException $exception) {
    echo 'Exception: ' . $exception->getMessage() . "\n";
}

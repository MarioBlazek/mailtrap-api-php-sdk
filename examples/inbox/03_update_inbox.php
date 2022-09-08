<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Faker\Factory;
use Marek\Mailtrap\API\Exception\Inbox\InboxNotFoundException;
use Marek\Mailtrap\API\Value\Request\InboxId;
use Marek\Mailtrap\API\Value\Request\UpdateInbox;
use Marek\Mailtrap\Core\Factory\InboxServiceFactory;

$inboxService = InboxServiceFactory::create(
    \file_get_contents(__DIR__ . '/../api_token'),
);

$faker = Factory::create();
$inboxId = new InboxId(1883775);
$updateInbox = new UpdateInbox($inboxId, $faker->company, $faker->userName);

try {
    $inbox = $inboxService->updateInbox($updateInbox);

    echo "Successfully updated!\n";
    echo "Inbox #{$inbox->id}\n";
    echo "Name: {$inbox->name}\n";
    echo "Email username: {$inbox->emailUsername}\n";
} catch (InboxNotFoundException $exception) {
    echo 'Exception: ' . $exception->getMessage() . "\n";
}

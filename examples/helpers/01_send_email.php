<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Faker\Factory;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

$transport = Transport::fromDsn(\file_get_contents(__DIR__ . '/../mailer_dsn'));
$mailer = new Mailer($transport);
$faker = Factory::create();

$email = (new Email())
    ->from($faker->email)
    ->to($faker->email)
    ->subject($faker->text(50))
    ->text($faker->text)
    ->html($faker->randomHtml);

$mailer->send($email);

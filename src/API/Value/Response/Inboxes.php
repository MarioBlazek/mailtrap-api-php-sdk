<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Value\Response;

use ArrayIterator;
use IteratorAggregate;

use function array_filter;
use function count;

final class Inboxes implements IteratorAggregate
{
    /**
     * @var Inbox[]
     */
    public array $inboxes = [];

    public int $count = 0;

    /**
     * @param Inbox[] $inboxes
     */
    public function __construct(array $inboxes)
    {
        $this->inboxes = $inboxes;
        $this->count = count($this->inboxes);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->inboxes);
    }

    /**
     * @return array<Inbox>
     */
    public function getInboxByName(string $name): array
    {
        return array_filter($this->inboxes, static function (Inbox $inbox) use ($name): bool {
            return $inbox->name === $name;
        });
    }
}

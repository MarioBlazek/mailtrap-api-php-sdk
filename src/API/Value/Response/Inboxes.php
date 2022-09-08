<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Value\Response;

use IteratorAggregate;
use ArrayIterator;

final class Inboxes implements IteratorAggregate
{
    /**
     * @var Inbox[]
     */
    public array $inboxes = [];

    public int $count = 0;

    public function __construct(array $inboxes)
    {
        $this->inboxes = $inboxes;
        $this->count = count($this->inboxes);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->inboxes);
    }
}
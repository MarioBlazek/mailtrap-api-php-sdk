<?php

declare(strict_types=1);

namespace Marek\Mailtrap\API\Value\Response;

use IteratorAggregate;

use function count;

final class Projects implements IteratorAggregate
{
    /**
     * @var Project[]|array
     */
    public array $projects = [];

    public int $count = 0;

    /**
     * @param Project[] $projects
     */
    public function __construct(array $projects = [])
    {
        $this->projects = $projects;
        $this->count = count($projects);
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->projects);
    }
}

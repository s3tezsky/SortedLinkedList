<?php

declare(strict_types=1);

namespace App\SortedLinkedList;

class Node
{
    public function __construct(
        public readonly int|string $value,
        public ?self $next = null,
    ) {}
}

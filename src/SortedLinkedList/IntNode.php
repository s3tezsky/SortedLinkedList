<?php

declare(strict_types=1);

namespace App\SortedLinkedList;

class IntNode
{
    public function __construct(
        public readonly int $value,
        public ?self $next = null,
    ) {}
}

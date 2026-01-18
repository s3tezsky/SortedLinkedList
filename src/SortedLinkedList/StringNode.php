<?php

declare(strict_types=1);

namespace App\SortedLinkedList;

class StringNode
{
    public function __construct(
        public readonly string $value,
        public ?self $next = null,
    ) {}
}

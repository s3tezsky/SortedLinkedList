<?php

declare(strict_types=1);

namespace App\SortedLinkedList;

/**
 * @internal
 * @template T of int|string
 */
class Node
{
    /**
     * @param T $value
     * @param Node<T>|null $next
     */
    public function __construct(
        public readonly int|string $value,
        public ?self $next = null,
    ) {}
}

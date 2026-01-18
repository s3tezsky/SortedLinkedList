<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\SortedLinkedList\SortedLinkedList;
use PHPUnit\Framework\TestCase;

class SortedLinkedListTest extends TestCase
{
    public function testCreateSortedLinkedListFromIntegers(): void
    {
        $sortedLinkedList = new SortedLinkedList([5, 3, 6, 1, 2, 4]);
        self::assertSame([1, 2, 3, 4, 5, 6], $sortedLinkedList->toArray());
    }

    public function testAddIntToSortedLinkedListFromIntegers(): void
    {
        $sortedLinkedList = new SortedLinkedList([3, 6, 1, 4]);
        $sortedLinkedList->add(5);
        $sortedLinkedList->add(2);
        self::assertSame([1, 2, 3, 4, 5, 6], $sortedLinkedList->toArray());
    }

    public function testAddIntToSortedLinkedList(): void
    {
        $sortedLinkedList = new SortedLinkedList();
        $sortedLinkedList->add(5);
        $sortedLinkedList->add(2);
        self::assertSame([2, 5], $sortedLinkedList->toArray());
    }
}

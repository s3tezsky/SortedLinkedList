<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\SortedLinkedList\SortedLinkedList;
use App\SortedLinkedList\UnsupportedTypeOfNodeValue;
use LogicException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use stdClass;

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

    public function testCreateSortedLinkedListFromStrings(): void
    {
        $sortedLinkedList = new SortedLinkedList(['banana', 'apple', 'mango', 'pineapple']);
        self::assertSame(['apple', 'banana', 'mango', 'pineapple'], $sortedLinkedList->toArray());
    }

    public function testAddStringToSortedLinkedListFromStrings(): void
    {
        $sortedLinkedList = new SortedLinkedList(['banana', 'apple', 'mango', 'pineapple']);
        $sortedLinkedList->add('orange');
        $sortedLinkedList->add('lemon');
        self::assertSame(['apple', 'banana', 'lemon', 'mango', 'orange', 'pineapple'], $sortedLinkedList->toArray());
    }

    public function testAddStringToSortedLinkedList(): void
    {
        $sortedLinkedList = new SortedLinkedList();
        $sortedLinkedList->add('orange');
        $sortedLinkedList->add('Banana');
        $sortedLinkedList->add('lemon');
        $sortedLinkedList->add('Mango');
        self::assertSame(['Banana', 'lemon', 'Mango', 'orange'], $sortedLinkedList->toArray());
    }

    public function testAddStringToSortedLinkedListFromIntegersThrowsException(): void
    {
        $this->expectException(LogicException::class); // @todo

        $sortedLinkedList = new SortedLinkedList([5]);
        $sortedLinkedList->add('Banana');
    }

    public function testAddStringToIntSortedLinkedListThrowsException(): void
    {
        $this->expectException(LogicException::class); // @todo

        $sortedLinkedList = new SortedLinkedList();
        $sortedLinkedList->add(5);
        $sortedLinkedList->add('Banana');
    }

    public function testAddIntToSortedLinkedListFromStringsThrowsException(): void
    {
        $this->expectException(LogicException::class); // @todo

        $sortedLinkedList = new SortedLinkedList(['Banana']);
        $sortedLinkedList->add(5);
    }

    public function testAddIntToStringSortedLinkedListThrowsException(): void
    {
        $this->expectException(LogicException::class); // @todo

        $sortedLinkedList = new SortedLinkedList();
        $sortedLinkedList->add('orange');
        $sortedLinkedList->add(1);
    }

    #[DataProvider('invalidTypesForCreationDataProvider')]
    public function testCreateSortedLinkedListWithUnsupportedTypeFloat(
        mixed $invalidValue,
        string $invalidTypeName,
    ): void {
        $this->expectException(UnsupportedTypeOfNodeValue::class);
        $this->expectExceptionMessage(sprintf(
            'Unsupported type of value passed "%s". Allowed types: "integer, string".',
            $invalidTypeName,
        ));

        /** @phpstan-ignore argument.type */
        new SortedLinkedList([3, 1, $invalidValue]);
    }

    /**
     * @return array<int, array<mixed>>
     */
    public static function invalidTypesForCreationDataProvider(): array
    {
        return [
            [1.5, 'double'],
            [false, 'boolean'],
            [new stdClass(), 'object'],
            [[], 'array'],
            [null, 'NULL'],
        ];
    }
}

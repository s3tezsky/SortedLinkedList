<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\SortedLinkedList\NodeValueTypeMismatch;
use App\SortedLinkedList\SortedLinkedList;
use App\SortedLinkedList\SortOrder;
use App\SortedLinkedList\UnsupportedTypeOfNodeValue;
use App\SortedLinkedList\ValueNotPresentInList;
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

    public function testCreateSortedLinkedListFromIntegersSortedDesc(): void
    {
        $sortedLinkedList = new SortedLinkedList([5, 3, 6, 1, 2, 4], SortOrder::DESC);
        self::assertSame([6, 5, 4, 3, 2, 1], $sortedLinkedList->toArray());
    }

    public function testAddIntToSortedLinkedListFromIntegers(): void
    {
        $sortedLinkedList = new SortedLinkedList([3, 6, 1, 4]);
        $sortedLinkedList->add(5);
        $sortedLinkedList->add(2);
        self::assertSame([1, 2, 3, 4, 5, 6], $sortedLinkedList->toArray());
    }

    public function testAddIntToSortedLinkedListFromIntegersSortedDesc(): void
    {
        $sortedLinkedList = new SortedLinkedList([3, 6, 1, 4], SortOrder::DESC);
        $sortedLinkedList->add(5);
        $sortedLinkedList->add(2);
        self::assertSame([6, 5, 4, 3, 2, 1], $sortedLinkedList->toArray());
    }

    public function testAddIntToSortedLinkedList(): void
    {
        $sortedLinkedList = new SortedLinkedList();
        $sortedLinkedList->add(5);
        $sortedLinkedList->add(2);
        self::assertSame([2, 5], $sortedLinkedList->toArray());
    }

    public function testAddIntToSortedLinkedListSortedDesc(): void
    {
        $sortedLinkedList = new SortedLinkedList(sortOrder: SortOrder::DESC);
        $sortedLinkedList->add(5);
        $sortedLinkedList->add(2);
        self::assertSame([5, 2], $sortedLinkedList->toArray());
    }

    public function testCreateSortedLinkedListFromStrings(): void
    {
        $sortedLinkedList = new SortedLinkedList(['banana', 'apple', 'mango', 'pineapple']);
        self::assertSame(['apple', 'banana', 'mango', 'pineapple'], $sortedLinkedList->toArray());
    }

    public function testCreateSortedLinkedListFromStringsSortedDesc(): void
    {
        $sortedLinkedList = new SortedLinkedList(['banana', 'apple', 'mango', 'pineapple'], SortOrder::DESC);
        self::assertSame(['pineapple', 'mango', 'banana', 'apple'], $sortedLinkedList->toArray());
    }

    public function testAddStringToSortedLinkedListFromStrings(): void
    {
        $sortedLinkedList = new SortedLinkedList(['banana', 'apple', 'mango', 'pineapple']);
        $sortedLinkedList->add('orange');
        $sortedLinkedList->add('lemon');
        self::assertSame(['apple', 'banana', 'lemon', 'mango', 'orange', 'pineapple'], $sortedLinkedList->toArray());
    }

    public function testAddStringToSortedLinkedListFromStringsSortedDesc(): void
    {
        $sortedLinkedList = new SortedLinkedList(['banana', 'apple', 'mango', 'pineapple'], sortOrder: SortOrder::DESC);
        $sortedLinkedList->add('orange');
        $sortedLinkedList->add('lemon');
        self::assertSame(['pineapple', 'orange', 'mango', 'lemon', 'banana', 'apple'], $sortedLinkedList->toArray());
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

    public function testAddStringToSortedLinkedListSortedDesc(): void
    {
        $sortedLinkedList = new SortedLinkedList(sortOrder: SortOrder::DESC);
        $sortedLinkedList->add('orange');
        $sortedLinkedList->add('Banana');
        $sortedLinkedList->add('lemon');
        $sortedLinkedList->add('Mango');
        self::assertSame(['orange', 'Mango', 'lemon', 'Banana'], $sortedLinkedList->toArray());
    }

    public function testAddStringToSortedLinkedListFromIntegersThrowsException(): void
    {
        $this->expectException(NodeValueTypeMismatch::class);
        $this->expectExceptionMessage('Value of type "string" cannot be added to this "App\SortedLinkedList\SortedLinkedList". Only type of "integer" can be added.');

        $sortedLinkedList = new SortedLinkedList([5]);
        $sortedLinkedList->add('Banana');
    }

    public function testAddStringToIntSortedLinkedListThrowsException(): void
    {
        $this->expectException(NodeValueTypeMismatch::class);
        $this->expectExceptionMessage('Value of type "string" cannot be added to this "App\SortedLinkedList\SortedLinkedList". Only type of "integer" can be added.');

        $sortedLinkedList = new SortedLinkedList();
        $sortedLinkedList->add(5);
        $sortedLinkedList->add('Banana');
    }

    public function testAddIntToSortedLinkedListFromStringsThrowsException(): void
    {
        $this->expectException(NodeValueTypeMismatch::class);
        $this->expectExceptionMessage('Value of type "integer" cannot be added to this "App\SortedLinkedList\SortedLinkedList". Only type of "string" can be added.');

        $sortedLinkedList = new SortedLinkedList(['Banana']);
        $sortedLinkedList->add(5);
    }

    public function testAddIntToStringSortedLinkedListThrowsException(): void
    {
        $this->expectException(NodeValueTypeMismatch::class);
        $this->expectExceptionMessage('Value of type "integer" cannot be added to this "App\SortedLinkedList\SortedLinkedList". Only type of "string" can be added.');

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

    /**
     * @param array<int, int> $initialValues
     * @param array<int, int> $addingValues
     */
    #[DataProvider('valuesForCountableTestDataProvider')]
    public function testCountable(array $initialValues, array $addingValues, int $expectedCount): void
    {
        $list = new SortedLinkedList($initialValues);
        foreach ($addingValues as $value) {
            $list->add($value);
        }

        self::assertCount($expectedCount, $list);
    }

    /**
     * @return array<int, mixed>
     */
    public static function valuesForCountableTestDataProvider(): array
    {
        return [
            [[4, 5, 9], [], 3],
            [[], [2, 1, 8], 3],
            [[4, 8, 9], [2, 7, 8, 5], 7],
        ];
    }

    public function testTraversable(): void
    {
        $list = new SortedLinkedList([5, 1, 8, 2]);

        self::assertSame(
            [1, 2, 5, 8],
            iterator_to_array($list),
        );
    }

    public function testContainsValueInIntegerList(): void
    {
        $list = new SortedLinkedList([5, 1, 8, 2]);

        self::assertTrue($list->contains(2));
        self::assertTrue($list->contains(5));
        self::assertFalse($list->contains(3));
        self::assertFalse($list->contains(0));
    }

    public function testContainsValueInStringList(): void
    {
        $list = new SortedLinkedList(['apple', 'mango', 'orange', 'banana']);

        self::assertTrue($list->contains('mango'));
        self::assertTrue($list->contains('orange'));
        self::assertFalse($list->contains('Apple'));
        self::assertFalse($list->contains('car'));
    }

    /**
     * @param array<int> $initialValues
     * @param array<int> $removingValues
     * @param array<int> $expectedResult
     */
    #[DataProvider('integerValuesForRemovalFromListDataProvider')]
    public function testRemoveValueFromIntegerList(array $initialValues, array $removingValues, array $expectedResult): void
    {
        $list = new SortedLinkedList($initialValues);
        foreach ($removingValues as $removingValue) {
            $list->remove($removingValue);
        }

        self::assertEquals($expectedResult, $list->toArray());
    }

    /**
     * @return array<int, mixed>
     */
    public static function integerValuesForRemovalFromListDataProvider(): array
    {
        return [
            [[5, 1, 8], [1], [5, 8]],
            [[1, 5, 7, 3, 6], [3, 7], [1, 5, 6]],
            [[2, 4, 6, 8], [6, 8], [2, 4]],
        ];
    }

    /**
     * @param array<string> $initialValues
     * @param array<string> $removingValues
     * @param array<string> $expectedResult
     */
    #[DataProvider('stringValuesForRemovalFromListDataProvider')]
    public function testRemoveValueFromStringList(array $initialValues, array $removingValues, array $expectedResult): void
    {
        $list = new SortedLinkedList($initialValues);
        foreach ($removingValues as $removingValue) {
            $list->remove($removingValue);
        }

        self::assertEquals($expectedResult, $list->toArray());
    }

    /**
     * @return array<int, mixed>
     */
    public static function stringValuesForRemovalFromListDataProvider(): array
    {
        return [
            [['orange', 'mango', 'apple'], ['apple'], ['mango', 'orange']],
            [['banana', 'apple', 'orange', 'lemon', 'coconut'], ['banana', 'orange'], ['apple', 'coconut', 'lemon']],
            [['banana', 'mango', 'orange', 'lemon'], ['mango', 'orange'], ['banana', 'lemon']],
        ];
    }

    public function testRemoveNonExistentValueFromIntegerListThrowsException(): void
    {
        $list = new SortedLinkedList([5, 1, 8, 2]);

        $this->expectException(ValueNotPresentInList::class);
        $this->expectExceptionMessage('Value cannot be removed from the list. The list does not contain expected value.');
        $list->remove(3);
    }

    public function testRemoveNonExistentValueFromEmptyListThrowsException(): void
    {
        $list = new SortedLinkedList();

        $this->expectException(ValueNotPresentInList::class);
        $this->expectExceptionMessage('Value cannot be removed from the list. The list does not contain expected value.');
        $list->remove(3);
    }

    public function testRemoveNonExistentValueFromStringListThrowsException(): void
    {
        $list = new SortedLinkedList(['banana', 'mango', 'orange', 'lemon']);

        $this->expectException(ValueNotPresentInList::class);
        $this->expectExceptionMessage('Value cannot be removed from the list. The list does not contain expected value.');
        $list->remove('coconut');
    }
}

<?php

declare(strict_types=1);

namespace App\SortedLinkedList;

use Countable;
use IteratorAggregate;
use LogicException;
use Traversable;

/**
 * @implements IteratorAggregate<int, int|string>
 */
class SortedLinkedList implements Countable, IteratorAggregate
{
    private ?Node $head = null;

    private ?ListType $listType = null;

    /**
     * @param array<int>|array<string> $values
     */
    public function __construct(
        array $values = [],
        private readonly SortOrder $sortOrder = SortOrder::ASC,
    ) {
        foreach ($values as $value) {
            if (! $this->isTypeOfValueSupported($value)) {
                throw new UnsupportedTypeOfNodeValue($value);
            }

            $this->add($value);
        }
    }

    public function add(int|string $value): void
    {
        if ($this->listType === null) {
            $this->listType = ListType::getTypeFromValue($value);
        }

        $valueListType = ListType::getTypeFromValue($value);
        if ($this->listType !== $valueListType) {
            throw new NodeValueTypeMismatch(sprintf(
                'Value of type "%s" cannot be added to this "%s". Only type of "%s" can be added.',
                $valueListType->value,
                self::class,
                $this->listType->value,
            ));
        }

        $newNode = new Node($value);

        if ($this->head === null || $this->shouldBeBeforeNode($newNode, $this->head)) {
            $newNode->next = $this->head;
            $this->head = $newNode;
            return;
        }

        $currentNode = $this->head;
        while ($currentNode->next !== null && ! $this->shouldBeBeforeNode($newNode, $currentNode->next)) {
            $currentNode = $currentNode->next;
        }

        $newNode->next = $currentNode->next;
        $currentNode->next = $newNode;
    }

    public function contains(int|string $value): bool
    {
        $currentNode = $this->head;
        while ($currentNode !== null) {
            if ($value === $currentNode->value) {
                return true;
            }
            $currentNode = $currentNode->next;
        }

        return false;
    }

    public function remove(int|string $value): void
    {
        if ($this->head === null) {
            throw new ValueNotPresentInList($value, 'Value cannot be removed from the list. The list does not contain expected value.');
        }

        if ($this->head->value === $value) {
            $this->head = $this->head->next;
            return;
        }

        $currentNode = $this->head;
        while ($currentNode->next !== null) {
            if ($currentNode->next->value !== $value) {
                $currentNode = $currentNode->next;
                continue;
            }

            $currentNode->next = $currentNode->next->next;
            return;
        }

        throw new ValueNotPresentInList($value, 'Value cannot be removed from the list. The list does not contain expected value.');
    }

    /**
     * @return array<int>|array<string>
     */
    public function toArray(): array
    {
        $values = [];
        $current = $this->head;

        while ($current !== null) {
            $values[] = $current->value;
            $current = $current->next;
        }
        return $values;
    }

    public function count(): int
    {
        $i = 0;
        $currentNode = $this->head;
        while ($currentNode !== null) {
            $i++;
            $currentNode = $currentNode->next;
        }

        return $i;
    }

    /**
     * @return Traversable<int, int>|Traversable<int, string>
     */
    public function getIterator(): Traversable
    {
        $currentNode = $this->head;
        while ($currentNode !== null) {
            yield $currentNode->value;
            $currentNode = $currentNode->next;
        }
    }

    private function shouldBeBeforeNode(Node $newNode, Node $node): bool
    {
        if ($this->listType === ListType::Int) {
            return match ($this->sortOrder) {
                SortOrder::ASC => $newNode->value < $node->value,
                SortOrder::DESC => $newNode->value > $node->value,
            };
        }

        if ($this->listType === ListType::String) {
            if (! is_string($newNode->value) || ! is_string($node->value)) {
                throw new LogicException('Both of compared values must be type of string.'); // @todo: Better exception
            }
            $stringComparison = strcasecmp($newNode->value, $node->value);
            return match ($this->sortOrder) {
                SortOrder::ASC => $stringComparison < 0,
                SortOrder::DESC => $stringComparison > 0,
            };
        }

        throw new LogicException('Not implemented ListType case for comparison.'); // @todo: Better exception
    }

    private function isTypeOfValueSupported(mixed $value): bool
    {
        return is_int($value) || is_string($value);
    }
}

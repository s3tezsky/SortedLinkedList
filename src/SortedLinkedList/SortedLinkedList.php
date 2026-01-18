<?php

declare(strict_types=1);

namespace App\SortedLinkedList;

use Countable;
use IteratorAggregate;
use Traversable;

/**
 * @implements IteratorAggregate<int, int|string>
 */
class SortedLinkedList implements Countable, IteratorAggregate
{
    private IntNode|StringNode|null $head = null;

    /**
     * @param array<int>|array<string> $values
     */
    public function __construct(array $values = [])
    {
        foreach ($values as $value) {
            if (! $this->isTypeOfValueSupported($value)) {
                throw new UnsupportedTypeOfNodeValue($value);
            }

            $this->add($value);
        }
    }

    public function add(int|string $value): void
    {
        if (is_int($value)) {
            $this->addInt($value);
        }

        if (is_string($value)) {
            $this->addString($value);
        }
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

    private function addInt(int $value): void
    {
        if (! ($this->head instanceof IntNode || $this->head === null)) {
            throw new NodeValueTypeMismatch(sprintf(
                'Value of type "integer" cannot be added to this "%s". Only type of "%s" can be added.',
                self::class,
                gettype($this->head->value),
            ));
        }

        $newNode = new IntNode($value);

        if ($this->head === null || $newNode->value < $this->head->value) {
            $newNode->next = $this->head;
            $this->head = $newNode;
            return;
        }

        $currentNode = $this->head;
        while ($currentNode->next !== null && $currentNode->next->value < $newNode->value) {
            $currentNode = $currentNode->next;
        }

        $newNode->next = $currentNode->next;
        $currentNode->next = $newNode;
    }

    private function addString(string $value): void
    {
        if (! ($this->head instanceof StringNode || $this->head === null)) {
            throw new NodeValueTypeMismatch(sprintf(
                'Value of type "string" cannot be added to this "%s". Only type of "%s" can be added.',
                self::class,
                gettype($this->head->value),
            ));
        }

        $newNode = new StringNode($value);

        if ($this->head === null || strcasecmp($newNode->value, $this->head->value) < 0) {
            $newNode->next = $this->head;
            $this->head = $newNode;
            return;
        }

        $currentNode = $this->head;
        while ($currentNode->next !== null && strcasecmp($currentNode->next->value, $newNode->value) < 0) {
            $currentNode = $currentNode->next;
        }

        $newNode->next = $currentNode->next;
        $currentNode->next = $newNode;
    }

    private function isTypeOfValueSupported(mixed $value): bool
    {
        return is_int($value) || is_string($value);
    }
}

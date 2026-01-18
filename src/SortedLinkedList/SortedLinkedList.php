<?php

declare(strict_types=1);

namespace App\SortedLinkedList;

use LogicException;

class SortedLinkedList
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

    private function addInt(int $value): void
    {
        $newNode = new IntNode($value);

        if (! ($this->head instanceof IntNode || $this->head === null)) {
            throw new LogicException(); // @todo: Better exception
        }

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
        $newNode = new StringNode($value);

        if (! ($this->head instanceof StringNode || $this->head === null)) {
            throw new LogicException(); // @todo: Better exception
        }

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

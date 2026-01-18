<?php

declare(strict_types=1);

namespace App\SortedLinkedList;

class SortedLinkedList
{
    private ?Node $head = null;

    /**
     * @param array<int> $values
     */
    public function __construct(array $values = [])
    {
        foreach ($values as $value) {
            $this->add($value);
        }
    }

    public function add(int $value): void
    {
        $newNode = new Node($value);

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

    /**
     * @return array<int>
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
}

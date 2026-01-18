<?php

declare(strict_types=1);

namespace App\SortedLinkedList;

use InvalidArgumentException;

class UnsupportedTypeOfNodeValue extends InvalidArgumentException
{
    public function __construct(mixed $value)
    {
        parent::__construct(sprintf(
            'Unsupported type of value passed "%s". Allowed types: "%s".',
            gettype($value),
            implode(', ', ['integer', 'string']),
        ));
    }
}

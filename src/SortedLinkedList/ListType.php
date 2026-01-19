<?php

declare(strict_types=1);

namespace App\SortedLinkedList;

enum ListType: string
{
    case Int = 'integer';
    case String = 'string';

    public static function getTypeFromValue(int|string $value): self
    {
        return self::from(gettype($value));
    }
}

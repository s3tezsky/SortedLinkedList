<?php

declare(strict_types=1);

namespace App\SortedLinkedList;

use ValueError;

enum ListType: string
{
    case Int = 'integer';
    case String = 'string';

    /**
     * @throws UnsupportedListType
     */
    public static function getTypeFromValue(mixed $value): self
    {
        try {
            return self::from(gettype($value));
        } catch (ValueError) {
            throw new UnsupportedListType('Unsupported value type.');
        }
    }
}

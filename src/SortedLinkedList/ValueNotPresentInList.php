<?php

declare(strict_types=1);

namespace App\SortedLinkedList;

use RuntimeException;
use Throwable;

class ValueNotPresentInList extends RuntimeException
{
    public function __construct(
        public readonly mixed $value,
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}

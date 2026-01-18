<?php

declare(strict_types=1);

require '../vendor/autoload.php';

use App\SortedLinkedList\SortedLinkedList;

$randomValues = [];
for ($i = 0; $i < 100; $i++) {
    $randomValues[] = rand(0, 1000);
}

$sortedLinkedList = new SortedLinkedList($randomValues);

echo '<pre>';
var_dump($sortedLinkedList->toArray());
echo '</pre>';

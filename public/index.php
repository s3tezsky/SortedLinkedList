<?php

declare(strict_types=1);

require '../vendor/autoload.php';

use App\SortedLinkedList\SortedLinkedList;

$randomIntegers = [];
for ($i = 0; $i < 100; $i++) {
    $randomIntegers[] = rand(0, 1000);
}

$sortedIntegerLinkedList = new SortedLinkedList($randomIntegers);

echo '<pre>';
var_dump($sortedIntegerLinkedList->toArray());
echo '</pre>';



$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomStrings = [];
for ($i = 0; $i < 100; $i++) {
    $randomString = '';
    for ($j = 0; $j < rand(2, 4); $j++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    $randomStrings[] = $randomString;
}

$sortedStringLinkedList = new SortedLinkedList($randomStrings);

echo '<pre>';
var_dump($sortedStringLinkedList->toArray());
echo '</pre>';

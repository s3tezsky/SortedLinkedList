# SortedLinkedList

**Disclaimer: This repository is only for testing purposes. It will not be maintained in the future.**

SortedLinkedList allows you to create a linked list in given order - ascending or descending.
It allows you to handle integers or string in a list (bot not both at the same time).

## Usage

```php
// The list may be created with initial values
$list = new SortedLinkedList([5, 1, 8]); // The list is: 1 -> 5 -> 8]

// Allowed types are integers and strings only.
// The exception UnsupportedTypeOfNodeValue is thrown in case of trying to construct SortedLinkedList with a different type.
new SortedLinkedList([1.9]); // Throws UnsupportedTypeOfNodeValue exception

// This will add a 4 before 5
$list->add(4); // The list is: 1 -> 4 -> 5 -> 8

// The list implements Countable so we can easily get its size
count($list); // The result is: 4

// The list implements IteratorAggregate so it is traversable
foreach ($list as $key => $value) {
// ...
}

// We can check existence of value by `contains()` method.
$list->contains(5); // The result is: true

// Item from list can be removed by `remove()` method.
$list->remove(5); // The list is: 1 -> 4 -> 8

// When the value is not present in list the exception `ValueNotPresentInList` is thrown.
$list->remove(2); // Throws ValueNotPresentInList exception

// The list is sorted in ascending order by default.
// We can make it in descending order by passing an optional argument on initializing the SortedLinkedList
$listDesc = new SortedLinkedList(sortOrder: SortOrder::DESC);
$listDesc->add(2); // The list is: 2
$listDesc->add(5); // The list is: 5 -> 2
$listDesc->add(1); // The list is: 5 -> 2 -> 1
```

# Development

## Installation

Prerequisites:
- Docker Compose

Following command will run app on http://localhost:8080

```shell
docker compose up
```

## Code Quality Tools

### Easy Coding Standard

- Analyze
  - `docker compose exec php-fpm composer ecs`
- Fix
  - `docker compose exec php-fpm composer ecs-fix`

### PHPStan

- Analyze
  - `docker compose exec php-fpm composer phpstan`

### Tests

- Run unit tests
  - `docker compose exec php-fpm composer tests-unit`

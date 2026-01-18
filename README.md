# Usage

## Creation

```php
// The list may be created with initial values
$list = new SortedLinkedList([5, 1, 8]); // The list is: 1 -> 5 -> 8]

// This will add a 4 before 5
$list->add(4); // The list is: 1 -> 4 -> 5 -> 8
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

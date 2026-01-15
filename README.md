# Usage

_// TBD_

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

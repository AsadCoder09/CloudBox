# CloudBox

Production-grade cloud storage platform (Google Drive–style) built with Laravel 10, Sanctum, MySQL, and Bootstrap 5.

## Branch Workflow

- `main` → production-ready
- `develop` → active development
- `feature/auth`, `feature/storage`, `feature/security`, `feature/sharing`, `feature/admin`
- `test/api`
- `bugfix/*`
- `release/v1.0`

Only `main` is deployed. Features are developed in dedicated branches and merged into `develop`, then `release/*`, then `main`.

## Architecture

Layered architecture with SOLID principles:

- Controllers → Services → Repositories → Storage
- Middleware for auth, HTTPS enforcement, rate limiting, and signed URLs
- Centralized error handling and structured logging

See full architecture and API docs in `docs/`.

## Local Setup (planned)

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan serve
```

## Documentation

- [API Documentation](docs/api.md)
- [Architecture](docs/architecture.md)
- [Deployment Guide](docs/deployment.md)
- [Contribution Guide](docs/CONTRIBUTING.md)
- [Changelog](docs/CHANGELOG.md)

## Repository Structure

```
app/
  Http/
    Controllers/
    Middleware/
  Services/
  Repositories/

database/
  migrations/

docs/
  api.md
  architecture.md
  deployment.md
  CONTRIBUTING.md
  CHANGELOG.md
routes/
  api.php
storage/
  app/private
  app/trash
```

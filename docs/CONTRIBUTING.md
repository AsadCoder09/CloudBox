# Contributing to CloudBox

## Workflow

1. Create a feature branch (e.g., `feature/storage`).
2. Implement changes with tests.
3. Open PR into `develop`.
4. Merge into `release/*` for validation.
5. Merge into `main` for deployment.

## Commit Messages

Use conventional commits:

- `feat: add chunk upload service`
- `fix: handle signed URL expiry`
- `docs: update deployment guide`

## Code Style

- Keep controllers thin.
- Put business logic in services.
- Use repositories for persistence.
- No `try/catch` around imports.

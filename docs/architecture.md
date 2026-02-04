# CloudBox Architecture

## Overview

CloudBox uses a layered architecture with clear separation of concerns and SOLID-aligned service boundaries.

```
Clients (Web/Mobile)
        |
        v
API Routes -> Controllers -> Services -> Repositories -> Storage Layer
        |
        v
Middleware (Auth, Rate Limit, HTTPS, Signed URLs)
```

## Layers

### Controllers
- Handle HTTP requests and responses.
- Validate request payloads.
- Delegate business logic to Services.

### Services
- Core business logic (upload, sharing, encryption, restore).
- Transaction orchestration across repositories.

### Repositories
- Database access layer.
- Encapsulates Eloquent queries and persistence logic.

### Storage Layer
- Local disk or object storage abstraction.
- AES-256 encryption before writing.

## Security
- Laravel Sanctum for token authentication.
- HTTPS enforcement middleware.
- Signed URLs for downloads.
- Rate limiting for auth endpoints.
- Activity logs for audit trails.

## ASCII Diagram

```
                        +----------------------+
                        |    Web / API Client  |
                        +----------+-----------+
                                   |
                                   v
+------------------+     +----------------------+     +---------------------+
|   Middleware     | --> |     Controllers      | --> |       Services      |
|  Auth/HTTPS/etc. |     |  Validation, DTOs    |     |  Business Logic     |
+------------------+     +----------------------+     +----------+----------+
                                                             |
                                                             v
                                                   +---------------------+
                                                   |    Repositories     |
                                                   +----------+----------+
                                                             |
                                                             v
                                                   +---------------------+
                                                   |    Storage Layer    |
                                                   +---------------------+
                                                             |
                                                             v
                                                   +---------------------+
                                                   |  Object/Local Disk  |
                                                   +---------------------+
```

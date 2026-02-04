# CloudBox API Documentation

Base URL: `/api`

## Auth

| Method | Endpoint | Description | Middleware |
| --- | --- | --- | --- |
| POST | `/auth/register` | Register user | `guest` |
| POST | `/auth/login` | Login user | `guest` |
| POST | `/auth/logout` | Logout user | `auth:sanctum` |
| POST | `/auth/verify-email` | Verify email | `auth:sanctum` |
| POST | `/auth/forgot-password` | Request password reset | `guest` |
| POST | `/auth/reset-password` | Reset password | `guest` |
| GET | `/auth/me` | Current user | `auth:sanctum` |

## Files

| Method | Endpoint | Description | Middleware |
| --- | --- | --- | --- |
| POST | `/files/upload` | Upload file (supports chunk) | `auth:sanctum` |
| GET | `/files/{id}` | Get file metadata | `auth:sanctum` |
| GET | `/files/{id}/download` | Download file via signed URL | `auth:sanctum`, `signed` |
| PATCH | `/files/{id}` | Rename / move | `auth:sanctum` |
| DELETE | `/files/{id}` | Trash file | `auth:sanctum` |
| POST | `/files/{id}/restore` | Restore from trash | `auth:sanctum` |

## Folders

| Method | Endpoint | Description | Middleware |
| --- | --- | --- | --- |
| POST | `/folders` | Create folder | `auth:sanctum` |
| GET | `/folders/{id}` | Folder details | `auth:sanctum` |
| PATCH | `/folders/{id}` | Rename / move | `auth:sanctum` |
| DELETE | `/folders/{id}` | Trash folder | `auth:sanctum` |
| POST | `/folders/{id}/restore` | Restore folder | `auth:sanctum` |

## Share

| Method | Endpoint | Description | Middleware |
| --- | --- | --- | --- |
| POST | `/share` | Create share link | `auth:sanctum` |
| GET | `/share/{token}` | Access shared file | `signed` |
| POST | `/share/{token}/verify` | Verify password | `throttle:share` |
| GET | `/share/{token}/logs` | Access logs | `auth:sanctum` |

## Admin

| Method | Endpoint | Description | Middleware |
| --- | --- | --- | --- |
| GET | `/admin/users` | List users | `auth:sanctum`, `role:admin` |
| GET | `/admin/storage` | Storage analytics | `auth:sanctum`, `role:admin` |
| GET | `/admin/logs` | System logs | `auth:sanctum`, `role:admin` |

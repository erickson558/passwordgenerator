# Changelog

All notable changes to this project will be documented in this file.

The format is based on Keep a Changelog, and this project follows Semantic Versioning with `Vx.x.x` tags.

## [V1.0.1] - 2026-03-05
- Refactored architecture to separate frontend and backend concerns.
- Moved password generation business logic to `backend/password_service.php`.
- Created dedicated API endpoint in `api/password.php`.
- Extracted frontend CSS and JavaScript into `assets/css/app.css` and `assets/js/app.js`.
- Updated project documentation with the new structure and API path.

## [V1.0.0] - 2026-03-05
- Added robust password generation fallback when OpenSSL is unavailable in PHP.
- Added JSON no-cache response headers for generator endpoint.
- Introduced single source of truth for versioning via `VERSION` file.
- Exposed app version in UI and generator API response.
- Added automated GitHub Release workflow on pushes to `main`.
- Added Apache License 2.0.
- Expanded project documentation and operational guidelines in README.

## 🛡 Spam Detection Service

This service protects user registration by rejecting form submissions that:

- Contain filled honeypot fields (`form_token`)
- Are submitted too quickly (< 3 seconds)
- Contain links in the name field

This logic is testable, reusable, and framework-agnostic — designed to integrate cleanly with Fortify user creation.

Tests for this service are in `tests/Unit/SpamDetectionServiceTest.php`.

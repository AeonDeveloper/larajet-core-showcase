# larajet-core-showcase
This is a selective architectural glimpse into LaraJet, a Laravel-powered access control and user management system built for multi-tenant platforms.


# 🛫 LaraJet Core

**LaraJet** is a Laravel-native access control and user onboarding core, designed to power membership platforms, admin panels, or multi-tenant SaaS systems with clean, testable architecture.

This repo showcases select architecture patterns from LaraJet, the platform engine behind **Astria**, a private club membership app.

📄 License: Demo code only. Not for production use. See LICENSE.md.


> 💡 This is a public mirror for demonstration, hiring, and architectural discussion. Core logic is proprietary — this repo includes sanitized snippets and patterns.

---

## 🔐 Key Features

- **Role & Permission System**  
  Dynamic, database-driven roles and permissions with Gate integration — no bulky packages required.

- **Gate-Backed Access Control**  
  Define and test Laravel gates like `manage-assets` or `access-stratus`, with role or permission checks.

- **Superuser Override Logic**  
  Built-in `is_super` override for ninja-level control when needed.

- **Spam-Resistant Registration Flow**  
  Includes honeypot fields, link filters, and submission timing checks — all testable via unit tests.

- **Custom Artisan Command: `permissions:report`**  
  CLI output for all role-permission mappings, ideal for audits or admin dashboards.

- **Pest-Powered Tests**  
  Designed from day one with testability in mind — covering logic, commands, and gates.

---

## 🧪 Example Commands

```bash
php artisan permissions:report

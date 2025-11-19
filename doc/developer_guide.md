# Aunt Joy Restaurant – Developer Guide

## 1. Overall structure

The project is organised by **modules**, each with its own controllers, models, components and views:

```text
AuntJoyRestaurant/
  index.php
  config/
    database.php        # PDO connection helper (Database::getConnection)
    schemas/schema.sql  # DB schema (DDL)
    seeds/seed.sql      # Seed data (roles, demo meals, admin user)
  includes/
    auth.php            # session-based auth + role helpers

  customer/
    controllers/
    models/
    components/
    views/

  admin/
    controllers/
    models/
    components/
    views/

  sales/
    controllers/
    models/
    components/
    views/

  manager/
    controllers/
    models/
    components/
    views/
```

- Shared / cross-cutting logic lives in `config/` and `includes/`.
- Each module owns its pages and business logic inside its own folder.

---

## 2. Routing (index.php)

Routing is handled by `index.php` using **page/action** query parameters:

- Base URL: `index.php`
- Page parameter: `?page=...` (which logical page to show)
- Optional action parameter: `&action=...` (form submissions / POST actions)

Example URLs:

- Customer menu: `index.php?page=menu`
- Customer profile: `index.php?page=profile`
- Admin dashboard: `index.php?page=admin/dashboard`
- Sales orders: `index.php?page=sales/orders`
- Manager dashboard: `index.php?page=manager/dashboard`

Inside `index.php` a `switch ($page)` decides what to load:

```php path=null start=null
<?php
session_start();
require_once __DIR__ . '/includes/auth.php';

$page   = $_GET['page']   ?? 'home';
$action = $_GET['action'] ?? '';

switch ($page) {
    case 'menu':
        require_once __DIR__ . '/customer/views/menu.php';
        break;

    case 'admin/dashboard':
        requireRole(['admin']);
        require_once __DIR__ . '/admin/views/dashboard.php';
        break;

    // ...other pages...

    default:
        header('Location: index.php?page=menu');
        exit;
}
```

---

## 3. Database access

All code should use the shared `Database` helper in `config/database.php`:

```php path=null start=null
<?php
require_once __DIR__ . '/../../config/database.php';

$pdo = Database::getConnection();

$stmt = $pdo->query('SELECT * FROM meals ORDER BY name');
$meals = $stmt->fetchAll();
```

The schema lives in:

- `config/schemas/schema.sql` – structure for tables `roles`, `users`, `categories`, `meals`, `orders`, `order_items`.
- `config/seeds/seed.sql` – initial roles, some example meals, and a default admin user.

---

## 4. Auth and roles

Authentication and role-based access control are handled by `includes/auth.php`.

Helpers you can use in any controller or view:

```php path=null start=null
isLoggedIn(): bool
requireLogin(): void
getUserId(): ?int
getUserName(): string          // e.g. for navbar display
getUserRoleName(): ?string     // 'customer', 'admin', 'sales', 'manager'
requireRole(array $roles): void
```

Typical usage in a protected page (e.g. admin dashboard):

```php path=null start=null
<?php
require_once __DIR__ . '/../../../includes/auth.php';
requireRole(['admin']);

// page content here...
```

Your **login controller** (which you will implement) is responsible for:

- Verifying `email` + `password` against the `users` table.
- Setting these session variables on successful login:
  - `$_SESSION['user_id']`
  - `$_SESSION['user_name']`
  - `$_SESSION['user_role_name']` (must match one of the names in `roles.name`).

Logging out should clear the session and redirect back to `?page=login` or `?page=menu`.

---

## 5. Controllers and views per module (pattern)

For each module you will follow the same simple pattern.

### Example: Customer menu page

1. **Route** in `index.php`:

```php path=null start=null
case 'menu':
    require_once __DIR__ . '/customer/views/menu.php';
    break;
```

2. **View file** `customer/views/menu.php`:

```php path=null start=null
<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/auth.php';

$pdo = Database::getConnection();
$stmt = $pdo->query('SELECT * FROM meals ORDER BY name');
$meals = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Menu - Aunt Joy Restaurant</title>
</head>
<body>
<h1>Menu</h1>
<ul>
    <?php foreach ($meals as $meal): ?>
        <li>
            <?php echo htmlspecialchars($meal['name']); ?>
            - <?php echo number_format($meal['price'], 2); ?>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>
```

Later you can refactor common HTML (navbars, layouts) into module `components/` (e.g. `customer/components/layout.php`) but this simple pattern is enough to get started.

---

## 6. Suggested responsibilities per member

- **Member 1 – Customer module**
  - Implement routes and pages under `customer/` (menu, profile, my orders, etc.).
- **Member 2 – Admin module**
  - Implement admin dashboard and CRUD for meals/categories/users under `admin/`.
- **Member 3 – Sales module**
  - Implement order status management under `sales/`.
- **Member 4 – Manager module**
  - Implement reports and exports under `manager/`.
- **Member 5 – Core & integration**
  - Maintain `index.php`, `config/database.php`, `config/schemas/`, `config/seeds/`, and `includes/auth.php`.
  - Help others with shared DB / auth patterns.

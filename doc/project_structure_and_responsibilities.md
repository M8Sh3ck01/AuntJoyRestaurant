# Aunt Joy Restaurant Web Application

## Project Folder Structure

```text
AuntJoyRestaurant/
│
├── index.php                  # front controller, page/action router
├── .htaccess                  # (optional) Apache config for pretty URLs
│
├── database_config/
│   ├── database.php           # Database::getConnection() (PDO helper)
│   ├── schemas/
│   │   └── schema.sql         # DB schema (tables: roles, users, categories, meals, orders, order_items)
│   └── seeds/
│       └── seed.sql           # initial data (roles, demo meals, default admin user)
│
├── includes/
│   └── auth.php               # session-based auth + role helpers (isLoggedIn, requireRole, ...)
│
├── customer/
│   ├── controllers/           # PHP controllers for customer pages (menu, profile, my orders, ...)
│   ├── models/                # customer-side models (e.g. Meal.php, Order.php)
│   ├── components/            # reusable bits: layouts, nav, partials
│   └── views/                 # customer views (menu.php, orders.php, profile.php, ...)
│
├── admin/
│   ├── controllers/           # admin controllers (dashboard, meals, categories, users)
│   ├── models/                # admin-side models (Meal.php, Category.php, User.php, ...)
│   ├── components/            # admin layout, sidebar, topbar, partials
│   └── views/                 # admin views (dashboard.php, meals.php, categories.php, users.php)
│
├── sales/
│   ├── controllers/           # sales staff controllers (order list, status updates)
│   ├── models/                # sales-side models (Order.php)
│   ├── components/            # sales layout/sidebar if needed
│   └── views/                 # sales views (orders.php)
│
├── manager/
│   ├── controllers/           # manager controllers (reports, exports)
│   ├── models/                # manager-side models (Order.php)
│   ├── components/            # manager layout/sidebar if needed
│   └── views/                 # manager views (dashboard.php, reports.php)
│
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
│
├── exports/
│   ├── pdf/
│   └── excel/
│
└── doc/
    ├── project_structure_and_responsibilities.md
    └── developer_guide.md
```

## Team Members and Responsibilities

> Replace `Member X` with actual names once your group is fixed.

| Member | Name (fill in) | Main Module           | Main Folders            |
|--------|----------------|-----------------------|-------------------------|
| 1      |                | Customer              | `customer/`             |
| 2      |                | Admin                 | `admin/`                |
| 3      |                | Sales                 | `sales/`                |
| 4      |                | Manager               | `manager/`              |
| 5      |                | Core & Infrastructure | `config/`, `includes/`, `exports/` |

### Member 1 – Customer Module
- **Folder focus:** `customer/`
- **Controllers / pages:**
  - Routes like `index.php?page=menu`, `index.php?page=profile`, `index.php?page=my-orders`.
  - Implement customer controllers under `customer/controllers/` or simple view-based pages under `customer/views/`.
- **Views (UI templates):**
  - `customer/views/menu.php` (menu listing, search, filter by category)
  - `customer/views/orders.php` ("my orders" list)
  - `customer/views/profile.php` and related profile pages
- **Components:**
  - Customer navbar / layout partials in `customer/components/`.
- **Extra responsibilities:**
  - Implement client- and server-side validation for customer forms.
  - Work with DB tables `meals`, `orders`, `order_items`, `users` via the shared `Database` helper.

### Member 2 – Admin Module
- **Folder focus:** `admin/`
- **Controllers / pages:**
  - Routes like `index.php?page=admin/dashboard`, `index.php?page=admin/meals`, `index.php?page=admin/categories`, `index.php?page=admin/users`.
  - Implement admin controllers under `admin/controllers/` to handle CRUD actions.
- **Views (UI templates):**
  - All under `admin/views/*` (dashboard, meals, categories, users list/forms).
- **Components:**
  - Admin layout, sidebar, topbar in `admin/components/`.
- **Extra responsibilities:**
  - Ensure only admins can access admin pages (use `requireRole(['admin'])` from `includes/auth.php`).
  - Coordinate with Member 4 to expose data useful for reports (e.g., consistent statuses, categories).

### Member 3 – Sales Module
- **Folder focus:** `sales/`
- **Controllers / pages:**
  - Route: `index.php?page=sales/orders`.
  - Implement sales controllers under `sales/controllers/` for listing orders and updating status.
- **Views (UI templates):**
  - `sales/views/orders.php` (orders table, order detail page).
- **Components:**
  - Sales layout / sidebar in `sales/components/` (optional).
- **Extra responsibilities:**
  - Implement status flow: `pending -> preparing -> out_for_delivery -> delivered` using the `orders` table.
  - Make sure status changes are visible on customer "my orders" pages.

### Member 4 – Manager Module
- **Folder focus:** `manager/`
- **Controllers / pages:**
  - Routes like `index.php?page=manager/dashboard` and `index.php?page=manager/reports`.
  - Implement report controllers under `manager/controllers/`.
- **Views (UI templates):**
  - All under `manager/views/*` (dashboard, reports, filters, results).
- **Components:**
  - Manager layout / sidebar in `manager/components/` (optional).
- **Extra responsibilities:**
  - Implement SQL queries for monthly reports: total revenue, number of orders, best-selling items (using `orders` and `order_items`).
  - Implement export to PDF/Excel (using `exports/` folders and any libraries you choose).

### Member 5 – Core & Infrastructure
- **Folder focus:** `config/`, `includes/`, `exports/`, root `index.php`.
- **Routing and front controller:**
  - Set up and maintain `index.php` to route `?page=...&action=...` to the correct module controllers/views.
  - Implement basic 404 handling and redirections.
- **Database access:**
  - Maintain `config/database.php` and keep it in sync with `config/schemas/schema.sql`.
  - Help others use `Database::getConnection()` correctly in their modules.
- **Authentication & RBAC:**
  - Maintain `includes/auth.php` (login helpers, `requireLogin()`, `requireRole([...])`).
  - Ensure all protected pages use these helpers consistently.
- **Exports and shared utilities:**
  - Coordinate `exports/` (PDF/Excel) so both admin and manager modules can reuse the same logic.
- **Support for other modules:**
  - Add or adjust shared functions and configuration when other members need them.

### Shared Responsibilities (All Members)

- **Database design and scripts**
  - Work together on `config/schemas/schema.sql` and `config/seeds/seed.sql`.
  - Ensure all modules use the same table and column names.
- **Core and RBAC**
  - Help review and test `config/database.php`, `includes/auth.php`, and `index.php` (routing and access control).
- **Validation and security**
  - All forms must have both client-side and server-side validation.
  - Respect role-based access control in each module.
- **Documentation**
  - Keep this `doc/` folder updated as the project grows.
- **Testing and integration**
  - Each member tests their module separately and then together as a full system.

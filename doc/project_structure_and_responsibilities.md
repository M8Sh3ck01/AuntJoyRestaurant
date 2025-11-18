# Aunt Joy Restaurant Web Application

## Project Folder Structure

```text
AuntJoyRestaurant/
│
├── index.php
├── .htaccess
│
├── core/
│   ├── components/
│   │   ├── Router.php
│   │   ├── Controller.php
│   │   ├── Model.php
│   │   ├── Session.php
│   │   ├── Validator.php
│   │   └── helpers.php
│   ├── db/
│   │   ├── DB.php
│   │   └── DatabaseConfig.php
│   ├── rbac/
│   │   ├── Auth.php
│   │   └── AccessControl.php
│   └── templates/
│       ├── layout_main.php      # customer layout
│       ├── layout_admin.php     # admin layout
│       ├── layout_sales.php     # sales layout
│       └── layout_manager.php   # manager layout
│
├── models/
│   ├── User.php
│   ├── Role.php
│   ├── Category.php
│   ├── Meal.php
│   ├── Order.php
│   └── OrderItem.php
│
├── customer/
│   ├── controllers/
│   │   ├── MenuController.php
│   │   ├── CartController.php
│   │   └── OrderController.php
│   ├── views/
│   │   ├── menu/
│   │   ├── cart/
│   │   └── order/
│   └── components/
│
├── admin/
│   ├── controllers/
│   │   ├── DashboardController.php
│   │   ├── MealController.php
│   │   ├── CategoryController.php
│   │   └── UserController.php
│   ├── views/
│   │   ├── dashboard.php
│   │   ├── meals/
│   │   ├── categories/
│   │   └── users/
│   └── components/
│
├── sales/
│   ├── controllers/
│   │   └── OrderController.php
│   ├── views/
│   │   └── orders/
│   └── components/
│
├── manager/
│   ├── controllers/
│   │   └── ReportController.php
│   ├── views/
│   │   ├── dashboard.php
│   │   └── report.php
│   └── components/
│
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
│       └── uploads/
│           └── meals/
│
├── database/
│   ├── schema.sql
│   └── seed.sql
│
├── exports/
│   ├── pdf/
│   └── excel/
│
└── doc/
    └── project_structure_and_responsibilities.md
```

## Team Members and Responsibilities

> Replace `Member X` with actual names once your group is fixed.

| Member | Name (fill in) | Main Module | Main Folders |
|--------|----------------|-------------|--------------|
| 1      |                | Customer    | `customer/`  |
| 2      |                | Admin       | `admin/`     |
| 3      |                | Sales       | `sales/`     |
| 4      |                | Manager     | `manager/`   |

### Member 1  Customer Module
- **Folder focus:** `customer/`
- **Controllers (business logic):**
  - `customer/controllers/MenuController.php` (browse menu, search, filter by category)
  - `customer/controllers/CartController.php` (add/update/remove items, calculate totals)
  - `customer/controllers/OrderController.php` (checkout, place order, view "my orders")
- **Views (UI templates):**
  - `customer/views/menu/*` (menu listing, search results)
  - `customer/views/cart/*` (cart page)
  - `customer/views/order/*` (checkout form, success page, my orders)
- **Layout used:**
  - `core/templates/layout_main.php` (customer-facing layout)
- **Extra responsibilities:**
  - Implement client- and server-side validation for customer forms.
  - Work with shared models (`Meal`, `Order`, `OrderItem`, `User`) to implement the customer flow.

### Member 2  Admin Module
- **Folder focus:** `admin/`
- **Controllers (business logic):**
  - `admin/controllers/DashboardController.php` (admin home, summary stats)
  - `admin/controllers/MealController.php` (CRUD for meals, image upload, availability status)
  - `admin/controllers/CategoryController.php` (CRUD for categories)
  - `admin/controllers/UserController.php` (CRUD for system users and roles)
- **Views (UI templates):**
  - All under `admin/views/*` (dashboard, meals, categories, users)
- **Layout used:**
  - `core/templates/layout_admin.php` (admin layout with sidebar/topbar)
- **Extra responsibilities:**
  - Ensure only admins can access admin pages (use RBAC helpers from `core/rbac`).
  - Coordinate with Member 4 to expose data useful for reports (e.g., consistent statuses, categories).

### Member 3  Sales Module
- **Folder focus:** `sales/`
- **Controllers (business logic):**
  - `sales/controllers/OrderController.php` (list new/in-progress orders, update status)
- **Views (UI templates):**
  - `sales/views/orders/*` (orders table, order detail page)
- **Layout used:**
  - `core/templates/layout_sales.php` (sales staff layout)
- **Extra responsibilities:**
  - Implement status flow: `Pending -> Preparing -> Out for Delivery -> Delivered`.
  - Make sure changes to order status are visible to customers (e.g., on "my orders" page).

### Member 4  Manager Module
- **Folder focus:** `manager/`
- **Controllers (business logic):**
  - `manager/controllers/ReportController.php` (report filter form, results, exports)
- **Views (UI templates):**
  - All under `manager/views/*` (dashboard, report)
- **Layout used:**
  - `core/templates/layout_manager.php` (manager layout)
- **Extra responsibilities:**
  - Implement SQL queries for monthly reports: total revenue, number of orders, best-selling items.
  - Implement export to PDF/Excel (using `/exports` folders and any libraries you choose).

### Shared Responsibilities (All Members)

- **Database design and scripts**
  - Work together on `database/schema.sql` and `database/seed.sql`.
  - Ensure all modules use the same table and column names.
- **Core and RBAC**
  - Help review and test `core/db`, `core/rbac`, and `core/components` (routing, base controller, etc.).
- **Validation and security**
  - All forms must have both client-side and server-side validation.
  - Respect role-based access control in each module.
- **Documentation**
  - Keep this `doc/` folder updated as the project grows.
- **Testing and integration**
  - Each member tests their module separately and then together as a full system.

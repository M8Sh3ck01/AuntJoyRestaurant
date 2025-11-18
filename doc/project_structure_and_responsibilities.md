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

## Team Member Module Responsibilities

### Member 1 – Customer Module
- Folder focus: `customer/`
- Controllers:
  - `customer/controllers/MenuController.php`
  - `customer/controllers/CartController.php`
  - `customer/controllers/OrderController.php`
- Views:
  - `customer/views/menu/*`
  - `customer/views/cart/*`
  - `customer/views/order/*`
- Layout:
  - Uses `core/templates/layout_main.php`.

### Member 2 – Admin Module
- Folder focus: `admin/`
- Controllers:
  - `admin/controllers/DashboardController.php`
  - `admin/controllers/MealController.php`
  - `admin/controllers/CategoryController.php`
  - `admin/controllers/UserController.php`
- Views:
  - All under `admin/views/*` (dashboard, meals, categories, users).
- Layout:
  - Uses `core/templates/layout_admin.php`.

### Member 3 – Sales Module
- Folder focus: `sales/`
- Controllers:
  - `sales/controllers/OrderController.php`
- Views:
  - `sales/views/orders/*`
- Layout:
  - Uses `core/templates/layout_sales.php`.

### Member 4 – Manager Module
- Folder focus: `manager/`
- Controllers:
  - `manager/controllers/ReportController.php`
- Views:
  - All under `manager/views/*` (dashboard, report).
- Layout:
  - Uses `core/templates/layout_manager.php`.


<?php
/**
 * Front Controller - Main entry point
 *
 * Simple page/action router in the style of auntjoys_app.
 * Controllers and views will live under module folders
 * (customer/, admin/, sales/, manager/).
 */

session_start();

// Global auth helpers (login state and role checks)
require_once __DIR__ . '/includes/auth.php';

// Read route parameters
$page   = $_GET['page']   ?? 'home';
$action = $_GET['action'] ?? '';

switch ($page) {
    // -------- Auth routes (to be implemented) --------
    case 'login':
        // TODO: require customer/controllers/AuthController.php and call login or show login form
        echo 'TODO: login page';
        break;

    case 'logout':
        // TODO: implement logout controller that clears session and redirects
        echo 'TODO: logout';
        break;

    // -------- Admin module --------
    case 'admin/dashboard':
        requireRole(['admin']);
        // TODO: require admin/views/dashboard.php (and later AdminController if needed)
        echo 'TODO: admin dashboard';
        break;

    // -------- Sales module --------
    case 'sales/orders':
        requireRole(['sales']);
        // TODO: require sales/views/orders.php
        echo 'TODO: sales orders';
        break;

    // -------- Manager module --------
    case 'manager/dashboard':
        requireRole(['manager']);
        // TODO: require manager/views/dashboard.php
        echo 'TODO: manager dashboard';
        break;

    // -------- Customer module --------
    case 'menu':
        // Public menu page (no login required)
        // TODO: require customer/views/menu.php
        echo 'TODO: customer menu';
        break;

    case 'profile':
        requireLogin();
        // TODO: require customer/views/profile.php
        echo 'TODO: customer profile';
        break;

    // -------- Fallback / home --------
    case 'home':
    default:
        // For now just redirect guests to menu; later you can add a landing page.
        header('Location: index.php?page=menu');
        exit;
}

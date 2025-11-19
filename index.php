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
    // -------- Auth module (shared for all roles) --------
    case 'login':
        require_once __DIR__ . '/auth/views/login.php';
        break;

    case 'login_submit':
        require_once __DIR__ . '/auth/controllers/AuthController.php';
        (new AuthController())->login();
        break;

    case 'register':
        require_once __DIR__ . '/auth/views/register.php';
        break;

    case 'register_submit':
        require_once __DIR__ . '/auth/controllers/AuthController.php';
        (new AuthController())->register();
        break;

    case 'logout':
        require_once __DIR__ . '/auth/controllers/AuthController.php';
        (new AuthController())->logout();
        break;

    case 'unauthorized':
        require_once __DIR__ . '/auth/views/unauthorized.php';
        break;

    // -------- Admin module --------
    case 'admin/dashboard':
        requireRole(['admin']);
        require_once __DIR__ . '/admin/views/dashboard.php';
        break;

    // -------- Sales module --------
    case 'sales/orders':
        requireRole(['sales']);
        require_once __DIR__ . '/sales/views/orders.php';
        break;

    // -------- Manager module --------
    case 'manager/dashboard':
        requireRole(['manager']);
        require_once __DIR__ . '/manager/views/dashboard.php';
        break;

    // -------- Customer module --------
    case 'menu':
        // Public menu page (no login required)
        require_once __DIR__ . '/customer/views/menu.php';
        break;

    case 'profile':
        requireLogin();
        require_once __DIR__ . '/customer/views/profile.php';
        break;

    // -------- Fallback / home --------
    case 'home':
    default:
        // For now just redirect guests to menu; later you can add a landing page.
        header('Location: index.php?page=menu');
        exit;
}

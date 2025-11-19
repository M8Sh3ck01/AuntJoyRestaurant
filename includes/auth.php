<?php
/**
 * Authentication and Role-Based Access Control (RBAC) helpers
 *
 * These helpers assume:
 * - users table with columns: id, name, email, password_hash, role_id
 * - roles table with columns: id, name (e.g. 'customer', 'admin', 'sales', 'manager')
 * - your login controller sets session keys: user_id, user_name, user_role_name
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check if a user is logged in
 */
function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

/**
 * Require the user to be logged in, or redirect to login page
 */
function requireLogin(): void
{
    if (!isLoggedIn()) {
        $_SESSION['error'] = 'Please login to access this page';
        header('Location: index.php?page=login');
        exit;
    }
}

/**
 * Get current user ID (or null if guest)
 */
function getUserId(): ?int
{
    return $_SESSION['user_id'] ?? null;
}

/**
 * Get current user display name
 */
function getUserName(): string
{
    return $_SESSION['user_name'] ?? 'Guest';
}

/**
 * Get current user role name (e.g. 'admin', 'customer')
 */
function getUserRoleName(): ?string
{
    return $_SESSION['user_role_name'] ?? null;
}

/**
 * Require the current user to have one of the given role names
 * Example: requireRole(['admin']); or requireRole(['sales','manager']);
 */
function requireRole(array $allowedRoles): void
{
    requireLogin();

    $role = getUserRoleName();
    if ($role === null || !in_array($role, $allowedRoles, true)) {
        $_SESSION['error'] = 'You do not have permission to access this page';
        header('Location: index.php?page=unauthorized');
        exit;
    }
}


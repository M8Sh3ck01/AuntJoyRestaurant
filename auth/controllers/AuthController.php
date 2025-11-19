<?php

require_once __DIR__ . '/../../database_config/database.php';
require_once __DIR__ . '/../../includes/auth.php';

class AuthController
{
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=login');
            exit;
        }

        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $errors   = [];

        if ($email === '' || $password === '') {
            $errors[] = 'Email and password are required';
        }

        if ($errors) {
            $_SESSION['error'] = implode(', ', $errors);
            header('Location: index.php?page=login');
            exit;
        }

        $pdo = Database::getConnection();

        $stmt = $pdo->prepare(
            'SELECT u.id, u.name, u.email, u.password_hash, r.name AS role_name
             FROM users u
             JOIN roles r ON u.role_id = r.id
             WHERE u.email = :email
             LIMIT 1'
        );
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if (!$user) {
            $_SESSION['error'] = 'Invalid email or password';
            header('Location: index.php?page=login');
            exit;
        }

        $stored = $user['password_hash'] ?? '';
        $ok = false;

        // If stored hash looks like password_hash() (starts with $), use password_verify
        if (isset($stored[0]) && $stored[0] === '$') {
            $ok = password_verify($password, $stored);
        } else {
            // For classroom/demo use we also allow plain-text match
            $ok = hash_equals($stored, $password);
        }

        if (!$ok) {
            $_SESSION['error'] = 'Invalid email or password';
            header('Location: index.php?page=login');
            exit;
        }

        // Set session according to includes/auth.php contract
        $_SESSION['user_id']        = $user['id'];
        $_SESSION['user_name']      = $user['name'];
        $_SESSION['user_role_name'] = $user['role_name']; // 'customer', 'admin', 'sales', 'manager'

        // Redirect by role
        switch ($user['role_name']) {
            case 'admin':
                header('Location: index.php?page=admin/dashboard');
                break;
            case 'sales':
                header('Location: index.php?page=sales/orders');
                break;
            case 'manager':
                header('Location: index.php?page=manager/dashboard');
                break;
            default: // customer or any other
                header('Location: index.php?page=menu');
                break;
        }
        exit;
    }

    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }

    /**
     * Basic customer registration.
     * Creates a user with role 'customer' and then redirects to login.
     */
    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=register');
            exit;
        }

        $name             = trim($_POST['name'] ?? '');
        $email            = trim($_POST['email'] ?? '');
        $password         = $_POST['password'] ?? '';
        $confirmPassword  = $_POST['confirm_password'] ?? '';
        $errors           = [];

        if ($name === '' || strlen($name) < 3) {
            $errors[] = 'Name must be at least 3 characters';
        }
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Valid email is required';
        }
        if ($password === '' || strlen($password) < 6) {
            $errors[] = 'Password must be at least 6 characters';
        }
        if ($password !== $confirmPassword) {
            $errors[] = 'Passwords do not match';
        }

        $pdo = Database::getConnection();

        // Check email already used
        if ($email !== '') {
            $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
            $stmt->execute([':email' => $email]);
            if ($stmt->fetch()) {
                $errors[] = 'Email is already registered';
            }
        }

        if ($errors) {
            $_SESSION['error'] = implode(', ', $errors);
            header('Location: index.php?page=register');
            exit;
        }

        // Get role_id for customer
        $roleStmt = $pdo->prepare("SELECT id FROM roles WHERE name = 'customer' LIMIT 1");
        $roleStmt->execute();
        $role = $roleStmt->fetch();
        if (!$role) {
            $_SESSION['error'] = 'Customer role not found in roles table';
            header('Location: index.php?page=register');
            exit;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $insert = $pdo->prepare(
            'INSERT INTO users (name, email, password_hash, role_id)
             VALUES (:name, :email, :password_hash, :role_id)'
        );

        $ok = $insert->execute([
            ':name'          => $name,
            ':email'         => $email,
            ':password_hash' => $hash,
            ':role_id'       => $role['id'],
        ]);

        if (!$ok) {
            $_SESSION['error'] = 'Failed to register user';
            header('Location: index.php?page=register');
            exit;
        }

        $_SESSION['success'] = 'Registration successful. Please login.';
        header('Location: index.php?page=login');
        exit;
    }
}


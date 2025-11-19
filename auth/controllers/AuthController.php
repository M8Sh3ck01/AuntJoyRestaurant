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

        if (!$user || !password_verify($password, $user['password_hash'])) {
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
}


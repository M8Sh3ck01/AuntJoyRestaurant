<?php

namespace Core\Rbac;

use Core\Components\Session;
use Core\Db\DB;
use PDO;

class Auth
{
    private Session $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function login(string $email, string $password): bool
    {
        $pdo = DB::getConnection();

        $stmt = $pdo->prepare('SELECT u.id, u.name, u.email, u.password_hash, r.name AS role_name, r.id AS role_id
                               FROM users u
                               JOIN roles r ON u.role_id = r.id
                               WHERE u.email = :email
                               LIMIT 1');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        // For now, support both PASSWORD() hashes and password_hash() hashes.
        if (!($this->verifyPassword($password, $user['password_hash']))) {
            return false;
        }

        $this->session->set('user_id', $user['id']);
        $this->session->set('user_role', $user['role_name']);

        return true;
    }

    private function verifyPassword(string $plain, string $stored): bool
    {
        // If stored hash looks like password_hash() (starts with $), use password_verify
        if (str_starts_with($stored, '$')) {
            return password_verify($plain, $stored);
        }

        // Otherwise, fallback: compare MySQL PASSWORD() equivalent is not trivial in PHP,
        // so for now we accept a direct match for local/demo scenarios.
        return $plain === $stored;
    }

    public function logout(): void
    {
        $this->session->remove('user_id');
        $this->session->remove('user_role');
    }

    public function isGuest(): bool
    {
        return !$this->session->has('user_id');
    }

    public function userId(): ?int
    {
        return $this->session->get('user_id');
    }

    public function role(): ?string
    {
        return $this->session->get('user_role');
    }

    public function hasRole(string|array $roles): bool
    {
        $currentRole = $this->role();
        if ($currentRole === null) {
            return false;
        }

        $roles = (array)$roles;
        return in_array($currentRole, $roles, true);
    }
}

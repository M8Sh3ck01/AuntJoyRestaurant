<?php

namespace Core\Rbac;

class AccessControl
{
    public static function requireRole(string|array $roles): void
    {
        $auth = new Auth();

        if ($auth->isGuest()) {
            http_response_code(302);
            header('Location: index.php?r=auth/login');
            exit;
        }

        if (!$auth->hasRole($roles)) {
            http_response_code(403);
            echo 'Forbidden: insufficient permissions';
            exit;
        }
    }
}

<?php

namespace Models;

use Core\Db\DB;
use PDO;

class Role
{
    public static function all(): array
    {
        $pdo = DB::getConnection();
        $stmt = $pdo->query('SELECT * FROM roles ORDER BY id');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

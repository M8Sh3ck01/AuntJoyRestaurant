<?php

namespace Core\Db;

use PDO;
use PDOException;

class DB
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s',
                DatabaseConfig::DB_HOST,
                DatabaseConfig::DB_NAME,
                DatabaseConfig::DB_CHARSET
            );

            try {
                self::$connection = new PDO(
                    $dsn,
                    DatabaseConfig::DB_USER,
                    DatabaseConfig::DB_PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            } catch (PDOException $e) {
                // In production, you would log this instead of echoing.
                die('Database connection failed: ' . $e->getMessage());
            }
        }

        return self::$connection;
    }
}

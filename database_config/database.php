<?php
/**
 * Database configuration and connection helper
 *
 * Simple singleton wrapper around PDO for the aunt_joy_db schema
 */

class Database
{
    private static ?PDO $connection = null;

    /**
     * Get shared PDO connection
     */
    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $host    = '127.0.0.1';
            $dbName  = 'aunt_joy_db'; // must match database/schema.sql
            $user    = 'root';        // adjust if your MySQL user is different
            $pass    = '';            // set your password if any
            $charset = 'utf8mb4';

            $dsn = "mysql:host={$host};dbname={$dbName};charset={$charset}";

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            try {
                self::$connection = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $e) {
                // In a student project, a simple die() is acceptable; in production you would log this.
                die('Database connection failed: ' . $e->getMessage());
            }
        }

        return self::$connection;
    }
}


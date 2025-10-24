<?php
/**
 * DATABASE CONFIGURATION FILE
 * This file contains database connection settings and PDO connection
 */

// Database credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'pdo_demo');
define('DB_USER', 'root');          // Change if needed
define('DB_PASS', '');              // Change if needed
define('DB_CHARSET', 'utf8mb4');

/**
 * Create PDO connection
 * @return PDO|null Returns PDO object or null on failure
 */
function getConnection() {
    try {
        // Data Source Name (DSN)
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        
        // PDO options for better error handling and security
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // Throw exceptions on errors
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // Fetch associative arrays by default
            PDO::ATTR_EMULATE_PREPARES   => false,                   // Use real prepared statements
        ];
        
        // Create PDO instance
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        
        return $pdo;
        
    } catch (PDOException $e) {
        // Display error message
        die("Connection failed: " . $e->getMessage());
    }
}

// Test connection (optional - comment out in production)
// $pdo = getConnection();
// echo "Database connection successful!";
?>
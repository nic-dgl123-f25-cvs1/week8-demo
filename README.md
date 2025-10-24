# PHP PDO Demo: Step-by-Step Guide
## Fetching Data from MySQL Database using PDO

---

## 📋 Table of Contents
1. [Introduction](#introduction)
2. [Prerequisites](#prerequisites)
3. [Setup Instructions](#setup-instructions)
4. [Understanding PDO](#understanding-pdo)
5. [Demo Explanations](#demo-explanations)
6. [Common PDO Methods](#common-pdo-methods)
7. [Best Practices](#best-practices)
8. [Troubleshooting](#troubleshooting)

---

## Introduction

This demo package teaches how to fetch data from a MySQL database using **PDO (PHP Data Objects)** - the modern, secure way to interact with databases in PHP.

**What's Included:**
- SQL file to create sample database
- Configuration file for database connection
- 5 demo files showing different fetch techniques
- Main menu (index.php) to navigate demos

---

## Prerequisites

Before starting, ensure you have:
- ✓ XAMPP, WAMP, or similar PHP development environment
- ✓ PHP 7.0 or higher
- ✓ MySQL/MariaDB database server
- ✓ phpMyAdmin (usually included with XAMPP/WAMP)
- ✓ Basic knowledge of PHP and SQL

---

## Setup Instructions

### Step 1: Start Your Server
1. Start Apache and MySQL from XAMPP/WAMP control panel
2. Verify they're running (Apache on port 80, MySQL on port 3306)

### Step 2: Create the Database
1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Click on "SQL" tab
3. Copy the entire contents of `setup_database.sql`
4. Paste into the SQL query box
5. Click "Go" to execute
6. You should see a success message

**What this creates:**
- Database named `pdo_demo`
- Table named `students` with 6 sample records
- Columns: id, name, email, major, gpa, enrollment_date, created_at

### Step 3: Configure Database Connection
1. Open `config.php`
2. Update these constants if needed:
   ```php
   define('DB_HOST', 'localhost');     // Usually 'localhost'
   define('DB_NAME', 'pdo_demo');      // Database name
   define('DB_USER', 'root');          // Default MySQL username
   define('DB_PASS', '');              // Default is empty for XAMPP
   ```

### Step 4: Place Files in Web Directory
1. Copy all PHP files to your web server directory:
   - XAMPP: `C:\xampp\htdocs\pdo_demo\`
   - WAMP: `C:\wamp64\www\pdo_demo\`
2. Keep files organized in one folder

### Step 5: Access the Demo
1. Open browser
2. Navigate to: http://localhost/pdo_demo/index.php
3. You should see the demo menu

---

## 🔍 Understanding PDO

### What is PDO?

**PDO (PHP Data Objects)** is a database abstraction layer that provides:
- Consistent interface for multiple database types
- Prepared statements (prevents SQL injection)
- Exception handling for errors
- Better security than older methods (mysql_* functions)

### PDO vs. MySQLi

| Feature | PDO | MySQLi |
|---------|-----|--------|
| Database Support | Multiple (MySQL, PostgreSQL, SQLite, etc.) | MySQL only |
| Prepared Statements | Yes | Yes |
| Object-Oriented | Yes | Yes (also procedural) |
| Named Parameters | Yes | No |

### Basic PDO Connection Pattern

```php
// 1. Create DSN (Data Source Name)
$dsn = "mysql:host=localhost;dbname=database_name;charset=utf8mb4";

// 2. Set options
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

// 3. Create PDO instance
$pdo = new PDO($dsn, $username, $password, $options);
```

---

## Demo Explanations

### Demo 1: Fetch All Records (02_fetch_all.php)

**Purpose:** Retrieve all rows from a table

**Key Concepts:**
- Using `query()` for simple SELECT statements
- Using `fetchAll()` to get all results at once
- Displaying results in an HTML table

**Code Flow:**
```php
$sql = "SELECT * FROM students";
$stmt = $pdo->query($sql);        // Execute query
$students = $stmt->fetchAll();    // Get all rows
// Loop through and display
```

**When to Use:**
- Need all records from a table
- No dynamic parameters needed
- Small to medium result sets

---

### Demo 2: Fetch Single Record (03_fetch_single.php)

**Purpose:** Get one specific record using WHERE clause

**Key Concepts:**
- **Prepared Statements** with placeholders
- Using `prepare()` and `execute()`
- Using `fetch()` for single row
- Named parameters (`:id`)

**Code Flow:**
```php
$sql = "SELECT * FROM students WHERE id = :id";
$stmt = $pdo->prepare($sql);           // Prepare
$stmt->execute(['id' => $student_id]); // Execute with parameter
$student = $stmt->fetch();             // Get one row
```

**Why Prepared Statements?**
- ✓ Prevents SQL injection attacks
- ✓ Database can optimize query plan
- ✓ Cleaner, more readable code

---

### Demo 3: Filter Records (04_fetch_filtered.php)

**Purpose:** Show various filtering techniques

**Key Concepts:**
- WHERE with exact match
- WHERE with comparison operators (>=, <=, <, >)
- LIKE with wildcards (%)
- Multiple examples in one file

**Examples Shown:**
1. Filter by major: `WHERE major = :major`
2. Filter by GPA: `WHERE gpa >= :min_gpa`
3. Search with LIKE: `WHERE name LIKE :search`

**LIKE Wildcards:**
- `%` = zero or more characters
- `_` = exactly one character
- Example: `%john%` matches "John", "Johnson", "johnny"

---

### Demo 4: COUNT and GROUP BY (05_count_groupby.php)

**Purpose:** Demonstrate aggregate functions

**Key Concepts:**
- COUNT(*) to count rows
- AVG() for average
- MIN() and MAX() for minimum/maximum
- GROUP BY to group results

**Examples:**
```php
// Count all students
SELECT COUNT(*) as total FROM students

// Count by major
SELECT major, COUNT(*) as count 
FROM students 
GROUP BY major

// Statistics
SELECT MIN(gpa), MAX(gpa), AVG(gpa) FROM students
```

---

### Demo 5: Different Fetch Modes (06_fetch_modes.php)

**Purpose:** Explore various ways to fetch data

**Fetch Modes:**

1. **FETCH_ASSOC** (Default)
   - Returns associative array
   - Access: `$row['column_name']`

2. **FETCH_NUM**
   - Returns numeric array
   - Access: `$row[0]`, `$row[1]`

3. **FETCH_OBJ**
   - Returns object
   - Access: `$row->column_name`

4. **FETCH_COLUMN**
   - Returns single column
   - Returns array of values

5. **FETCH_KEY_PAIR**
   - Returns key-value pairs
   - First column = key, second = value

**Usage:**
```php
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Associative
$rows = $stmt->fetchAll(PDO::FETCH_OBJ);    // Object
$names = $stmt->fetchAll(PDO::FETCH_COLUMN); // Single column
```

---

## Common PDO Methods

### Connection Methods

```php
// Create connection
$pdo = new PDO($dsn, $username, $password, $options);

// Check connection
if ($pdo) {
    echo "Connected successfully";
}
```

### Query Execution Methods

```php
// Simple query (no parameters)
$stmt = $pdo->query("SELECT * FROM table");

// Prepared statement
$stmt = $pdo->prepare("SELECT * FROM table WHERE id = :id");
$stmt->execute(['id' => 5]);
```

### Fetching Methods

```php
// Fetch all rows
$rows = $stmt->fetchAll();

// Fetch single row
$row = $stmt->fetch();

// Fetch single column value
$value = $stmt->fetchColumn();

// Count rows
$count = $stmt->rowCount();
```

### Error Handling

```php
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    // Your database operations
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
```

---

## Best Practices

### 1. Always Use Prepared Statements
```php
// NEVER DO THIS (vulnerable to SQL injection)
$sql = "SELECT * FROM users WHERE id = " . $_GET['id'];

// ALWAYS DO THIS
$sql = "SELECT * FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $_GET['id']]);
```

### 2. Use Try-Catch for Error Handling
```php
try {
    // Database operations
} catch (PDOException $e) {
    // Handle error appropriately
    error_log($e->getMessage());  // Log for debugging
    echo "An error occurred";      // User-friendly message
}
```

### 3. Use htmlspecialchars() for Output
```php
// Prevent XSS attacks
echo htmlspecialchars($student['name']);
```

### 4. Set PDO Attributes
```php
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Throw exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  // Fetch mode
    PDO::ATTR_EMULATE_PREPARES => false,  // Real prepared statements
];
```

### 5. Close Connections (Optional)
```php
// PDO automatically closes on script end, but you can:
$pdo = null;  // Close connection
```

---

## Troubleshooting

### Common Issues and Solutions

#### 1. "Access denied for user"
**Problem:** Wrong database credentials
**Solution:** 
- Check username/password in `config.php`
- Default XAMPP: user='root', password=''

#### 2. "Unknown database 'pdo_demo'"
**Problem:** Database not created
**Solution:** 
- Run `01_setup_database.sql` in phpMyAdmin
- Check database name spelling

#### 3. "Could not find driver"
**Problem:** PDO MySQL extension not enabled
**Solution:** 
- Open `php.ini`
- Uncomment: `;extension=pdo_mysql` → `extension=pdo_mysql`
- Restart Apache

#### 4. "Call to undefined function"
**Problem:** File not included properly
**Solution:** 
- Use correct path in `require_once 'config.php'`
- Check file locations

#### 5. Blank page / No output
**Problem:** PHP errors not displaying
**Solution:**
Add to top of PHP file:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

#### 6. "Headers already sent"
**Problem:** Output before header() function
**Solution:**
- Remove any spaces/newlines before `<?php`
- Check for echo statements before header()

---

## Additional Resources

### Official Documentation
- [PHP PDO Manual](https://www.php.net/manual/en/book.pdo.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)

### Learning Path
1. Master basic SELECT queries
2. Learn prepared statements thoroughly
3. Practice JOIN operations
4. Study transaction handling
5. Explore advanced PDO features

### Next Steps
After mastering these demos, explore:
- INSERT, UPDATE, DELETE with PDO
- JOIN operations between tables
- Transactions (COMMIT/ROLLBACK)
- Error handling strategies
- Building a complete CRUD application

---

## Summary

### The PDO Workflow:
1. **Connect** → Create PDO instance
2. **Prepare** → Write SQL with placeholders
3. **Execute** → Run query with parameters
4. **Fetch** → Get results in desired format
5. **Display** → Show data safely to users

---

## Quick Reference Card

```php
// CONNECTION
$pdo = new PDO($dsn, $user, $pass, $options);

// SIMPLE QUERY
$stmt = $pdo->query("SELECT * FROM table");
$rows = $stmt->fetchAll();

// PREPARED STATEMENT
$stmt = $pdo->prepare("SELECT * FROM table WHERE id = :id");
$stmt->execute(['id' => $id]);
$row = $stmt->fetch();

// COUNT
$stmt = $pdo->query("SELECT COUNT(*) FROM table");
$count = $stmt->fetchColumn();

// ERROR HANDLING
try {
    // code
} catch (PDOException $e) {
    echo $e->getMessage();
}
```

---

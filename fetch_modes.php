<?php
/**
 * DEMO 5: DIFFERENT FETCH MODES
 * This demonstrates various PDO fetch modes
 */

// Include database configuration
require_once 'config.php';

// Get database connection
$pdo = getConnection();

echo "<h2>Demo 5: Different Fetch Modes</h2>";
echo "<hr>";

try {
    $sql = "SELECT id, name, email, major FROM students LIMIT 2";
    
    // Fetch Mode 1: FETCH_ASSOC (Associative Array)
    echo "<h3>1. FETCH_ASSOC (Associative Array)</h3>";
    $stmt = $pdo->query($sql);
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($students);
    echo "</pre>";
    
    echo "<hr>";
    
    // Fetch Mode 2: FETCH_NUM (Numeric Array)
    echo "<h3>2. FETCH_NUM (Numeric Array)</h3>";
    $stmt = $pdo->query($sql);
    $students = $stmt->fetchAll(PDO::FETCH_NUM);
    echo "<pre>";
    print_r($students);
    echo "</pre>";
    
    echo "<hr>";
    
    // Fetch Mode 3: FETCH_OBJ (Object)
    echo "<h3>3. FETCH_OBJ (Object)</h3>";
    $stmt = $pdo->query($sql);
    $students = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo "<pre>";
    print_r($students);
    echo "</pre>";
    
    echo "<p><strong>Accessing object properties:</strong></p>";
    foreach ($students as $student) {
        echo "Name: " . $student->name . ", Email: " . $student->email . "<br>";
    }
    
    echo "<hr>";
    
    // Fetch Mode 4: FETCH_COLUMN (Single Column)
    echo "<h3>4. FETCH_COLUMN (Get single column)</h3>";
    $sql_names = "SELECT name FROM students";
    $stmt = $pdo->query($sql_names);
    $names = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "<pre>";
    print_r($names);
    echo "</pre>";
    
    echo "<hr>";
    
    // Fetch Mode 5: FETCH_KEY_PAIR (Key-Value pairs)
    echo "<h3>5. FETCH_KEY_PAIR (ID => Name pairs)</h3>";
    $sql_pairs = "SELECT id, name FROM students";
    $stmt = $pdo->query($sql_pairs);
    $pairs = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    echo "<pre>";
    print_r($pairs);
    echo "</pre>";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

echo "<br>";
echo "<a href='index.php'>Back to Menu</a>";
?>
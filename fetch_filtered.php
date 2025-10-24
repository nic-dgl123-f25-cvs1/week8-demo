<?php
/**
 * DEMO 3: FILTER RECORDS WITH WHERE AND LIKE
 * This demonstrates filtering data with conditions
 */

// Include database configuration
require_once 'config.php';

// Get database connection
$pdo = getConnection();

echo "<h2>Demo 3: Filter Records</h2>";
echo "<hr>";

try {
    // Example 1: Filter by major
    $major = "Computer Science";
    
    echo "<h3>Students in $major</h3>";
    
    $sql = "SELECT name, email, gpa 
            FROM students 
            WHERE major = :major 
            ORDER BY gpa DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['major' => $major]);
    $students = $stmt->fetchAll();
    
    echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse;'>";
    echo "<tr style='background-color: #e3f2fd;'>";
    echo "<th>Name</th><th>Email</th><th>GPA</th>";
    echo "</tr>";
    
    foreach ($students as $student) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($student['name']) . "</td>";
        echo "<td>" . htmlspecialchars($student['email']) . "</td>";
        echo "<td>" . htmlspecialchars($student['gpa']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<br><br>";
    
    // Example 2: Filter by GPA threshold
    $min_gpa = 3.50;
    
    echo "<h3>Students with GPA >= $min_gpa</h3>";
    
    $sql = "SELECT name, major, gpa 
            FROM students 
            WHERE gpa >= :min_gpa 
            ORDER BY gpa DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['min_gpa' => $min_gpa]);
    $students = $stmt->fetchAll();
    
    echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse;'>";
    echo "<tr style='background-color: #c8e6c9;'>";
    echo "<th>Name</th><th>Major</th><th>GPA</th>";
    echo "</tr>";
    
    foreach ($students as $student) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($student['name']) . "</td>";
        echo "<td>" . htmlspecialchars($student['major']) . "</td>";
        echo "<td>" . htmlspecialchars($student['gpa']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<br><br>";
    
    // Example 3: Search with LIKE
    $search_term = "%a%";  // Names containing 'a'
    
    echo "<h3>Students with 'a' in their name</h3>";
    
    $sql = "SELECT name, email, major 
            FROM students 
            WHERE name LIKE :search 
            ORDER BY name";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['search' => $search_term]);
    $students = $stmt->fetchAll();
    
    echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse;'>";
    echo "<tr style='background-color: #fff9c4;'>";
    echo "<th>Name</th><th>Email</th><th>Major</th>";
    echo "</tr>";
    
    foreach ($students as $student) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($student['name']) . "</td>";
        echo "<td>" . htmlspecialchars($student['email']) . "</td>";
        echo "<td>" . htmlspecialchars($student['major']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

echo "<br><br>";
echo "<a href='index.php'>Back to Menu</a>";
?>
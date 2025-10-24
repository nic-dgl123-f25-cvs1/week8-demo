<?php
/**
 * DEMO 1: FETCH ALL RECORDS
 * This demonstrates fetching all rows from a table
 */

// Include database configuration
require_once 'config.php';

// Get database connection
$pdo = getConnection();

echo "<h2>Demo 1: Fetch All Records</h2>";
echo "<hr>";

try {
    // Prepare SQL statement
    $sql = "SELECT id, name, email, major, gpa, enrollment_date FROM students ORDER BY name";
    
    // Execute query
    $stmt = $pdo->query($sql);
    
    // Fetch all results as associative array
    $students = $stmt->fetchAll();
    
    // Display results
    echo "<h3>All Students (Total: " . count($students) . ")</h3>";
    echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse;'>";
    echo "<tr style='background-color: #f2f2f2;'>";
    echo "<th>ID</th><th>Name</th><th>Email</th><th>Major</th><th>GPA</th><th>Enrollment Date</th>";
    echo "</tr>";
    
    foreach ($students as $student) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($student['id']) . "</td>";
        echo "<td>" . htmlspecialchars($student['name']) . "</td>";
        echo "<td>" . htmlspecialchars($student['email']) . "</td>";
        echo "<td>" . htmlspecialchars($student['major']) . "</td>";
        echo "<td>" . htmlspecialchars($student['gpa']) . "</td>";
        echo "<td>" . htmlspecialchars($student['enrollment_date']) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

echo "<br><br>";
echo "<a href='index.php'>Back to Menu</a>";
?>
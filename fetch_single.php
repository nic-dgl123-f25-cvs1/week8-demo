<?php
/**
 * DEMO 2: FETCH SINGLE RECORD WITH WHERE CLAUSE
 * This demonstrates using prepared statements with parameters
 */

// Include database configuration
require_once 'config.php';

// Get database connection
$pdo = getConnection();

echo "<h2>Demo 2: Fetch Single Record (Prepared Statement)</h2>";
echo "<hr>";

try {
    // Student ID to search for
    $student_id = 3;  // Change this to test different IDs
    
    // Prepare SQL statement with placeholder
    $sql = "SELECT id, name, email, major, gpa, enrollment_date 
            FROM students 
            WHERE id = :id";
    
    // Prepare statement
    $stmt = $pdo->prepare($sql);
    
    // Bind parameter and execute
    $stmt->execute(['id' => $student_id]);
    
    // Fetch single result
    $student = $stmt->fetch();
    
    // Display result
    if ($student) {
        echo "<h3>Student Details (ID: $student_id)</h3>";
        echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse;'>";
        echo "<tr><td><strong>ID:</strong></td><td>" . htmlspecialchars($student['id']) . "</td></tr>";
        echo "<tr><td><strong>Name:</strong></td><td>" . htmlspecialchars($student['name']) . "</td></tr>";
        echo "<tr><td><strong>Email:</strong></td><td>" . htmlspecialchars($student['email']) . "</td></tr>";
        echo "<tr><td><strong>Major:</strong></td><td>" . htmlspecialchars($student['major']) . "</td></tr>";
        echo "<tr><td><strong>GPA:</strong></td><td>" . htmlspecialchars($student['gpa']) . "</td></tr>";
        echo "<tr><td><strong>Enrollment Date:</strong></td><td>" . htmlspecialchars($student['enrollment_date']) . "</td></tr>";
        echo "</table>";
    } else {
        echo "<p style='color: red;'>No student found with ID: $student_id</p>";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

echo "<br><br>";
echo "<a href='index.php'>Back to Menu</a>";
?>
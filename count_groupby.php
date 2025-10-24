<?php
/**
 * DEMO 4: COUNT AND GROUP BY
 * This demonstrates aggregate functions and grouping
 */

// Include database configuration
require_once 'config.php';

// Get database connection
$pdo = getConnection();

echo "<h2>Demo 4: COUNT and GROUP BY</h2>";
echo "<hr>";

try {
    // Example 1: Count total students
    echo "<h3>Total Student Count</h3>";
    
    $sql = "SELECT COUNT(*) as total FROM students";
    $stmt = $pdo->query($sql);
    $result = $stmt->fetch();
    
    echo "<p style='font-size: 18px;'><strong>Total Students:</strong> " . $result['total'] . "</p>";
    
    echo "<br>";
    
    // Example 2: Count students by major
    echo "<h3>Students per Major</h3>";
    
    $sql = "SELECT major, COUNT(*) as count, AVG(gpa) as avg_gpa 
            FROM students 
            GROUP BY major 
            ORDER BY count DESC";
    
    $stmt = $pdo->query($sql);
    $majors = $stmt->fetchAll();
    
    echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse;'>";
    echo "<tr style='background-color: #f2f2f2;'>";
    echo "<th>Major</th><th>Number of Students</th><th>Average GPA</th>";
    echo "</tr>";
    
    foreach ($majors as $major) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($major['major']) . "</td>";
        echo "<td style='text-align: center;'>" . $major['count'] . "</td>";
        echo "<td style='text-align: center;'>" . number_format($major['avg_gpa'], 2) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<br><br>";
    
    // Example 3: Statistics
    echo "<h3>GPA Statistics</h3>";
    
    $sql = "SELECT 
                COUNT(*) as total_students,
                MIN(gpa) as min_gpa,
                MAX(gpa) as max_gpa,
                AVG(gpa) as avg_gpa
            FROM students";
    
    $stmt = $pdo->query($sql);
    $stats = $stmt->fetch();
    
    echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse;'>";
    echo "<tr style='background-color: #e8f5e9;'>";
    echo "<th>Statistic</th><th>Value</th>";
    echo "</tr>";
    echo "<tr><td><strong>Total Students</strong></td><td>" . $stats['total_students'] . "</td></tr>";
    echo "<tr><td><strong>Minimum GPA</strong></td><td>" . number_format($stats['min_gpa'], 2) . "</td></tr>";
    echo "<tr><td><strong>Maximum GPA</strong></td><td>" . number_format($stats['max_gpa'], 2) . "</td></tr>";
    echo "<tr><td><strong>Average GPA</strong></td><td>" . number_format($stats['avg_gpa'], 2) . "</td></tr>";
    echo "</table>";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

echo "<br><br>";
echo "<a href='index.php'>Back to Menu</a>";
?>
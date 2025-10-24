<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP PDO Demo - Fetching Data from MySQL</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #f5f5f5;
    }

    h1 {
        color: #333;
        border-bottom: 3px solid #4CAF50;
        padding-bottom: 10px;
    }

    .demo-menu {
        background-color: white;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .demo-item {
        background-color: #f9f9f9;
        border-left: 4px solid #4CAF50;
        padding: 15px;
        margin: 15px 0;
        transition: all 0.3s;
    }

    .demo-item:hover {
        background-color: #e8f5e9;
        transform: translateX(5px);
    }

    .demo-item h3 {
        margin: 0 0 10px 0;
        color: #2e7d32;
    }

    .demo-item p {
        margin: 0 0 10px 0;
        color: #666;
    }

    .demo-item a {
        display: inline-block;
        background-color: #4CAF50;
        color: white;
        padding: 8px 20px;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .demo-item a:hover {
        background-color: #45a049;
    }

    .setup-info {
        background-color: #fff3cd;
        border: 1px solid #ffc107;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .setup-info h3 {
        margin-top: 0;
        color: #856404;
    }

    .code {
        background-color: #f4f4f4;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 4px;
        font-family: 'Courier New', monospace;
        font-size: 14px;
    }
    </style>
</head>

<body>
    <h1>🎓 PHP PDO Demo: Fetching Data from MySQL</h1>

    <div class="demo-menu">
        <div class="setup-info">
            <h3>⚙️ Setup Instructions</h3>
            <p><strong>Before running these demos:</strong></p>
            <ol>
                <li>Run the SQL file: <span class="code">01_setup_database.sql</span> in phpMyAdmin</li>
                <li>Update database credentials in <span class="code">config.php</span> if needed</li>
                <li>Make sure your web server (XAMPP/WAMP) is running</li>
            </ol>
        </div>

        <h2>📚 Demo List</h2>

        <div class="demo-item">
            <h3>Demo 1: Fetch All Records</h3>
            <p>Learn how to retrieve all rows from a database table using <code>fetchAll()</code></p>
            <a href="fetch_all.php">View Demo →</a>
        </div>

        <div class="demo-item">
            <h3>Demo 2: Fetch Single Record</h3>
            <p>Demonstrates using prepared statements with WHERE clause and <code>fetch()</code></p>
            <a href="fetch_single.php">View Demo →</a>
        </div>

        <div class="demo-item">
            <h3>Demo 3: Filter Records</h3>
            <p>Shows various filtering techniques using WHERE, LIKE, and comparison operators</p>
            <a href="fetch_filtered.php">View Demo →</a>
        </div>

        <div class="demo-item">
            <h3>Demo 4: COUNT and GROUP BY</h3>
            <p>Demonstrates aggregate functions like COUNT(), AVG(), MIN(), MAX() and grouping</p>
            <a href="count_groupby.php">View Demo →</a>
        </div>

        <div class="demo-item">
            <h3>Demo 5: Different Fetch Modes</h3>
            <p>Explores various PDO fetch modes: FETCH_ASSOC, FETCH_OBJ, FETCH_COLUMN, etc.</p>
            <a href="fetch_modes.php">View Demo →</a>
        </div>
    </div>

    <div style="margin-top: 30px; text-align: center; color: #666;">
        <p>Created for PHP Class Demonstration | Using PDO for Database Operations</p>
    </div>
</body>

</html>
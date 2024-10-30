<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $job_title = $_POST['job_title'];
    $salary = $_POST['salary'];

    // Prepare the SQL statement using MySQLi
    $stmt = $conn->prepare("INSERT INTO employees (first_name, last_name, email, job_title, salary) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $first_name, $last_name, $email, $job_title, $salary);

    // Execute the statement and display a success or error message
    if ($stmt->execute()) {
        $message = "Employee created successfully.";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form label {
            display: block;
            margin-top: 10px;
            color: #555;
        }
        form input[type="text"],
        form input[type="email"],
        form input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 15px; /* Space between input fields and submit button */
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        form input[type="submit"]:hover {
            background-color: #218838;
        }
        .message {
            text-align: center;
            color: #333;
            margin-top: 15px;
        }
        .button {
            width: block;
            padding: 10px;
            margin-top: 15px; /* Increased space between buttons */
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            display: block; /* Ensures the button takes full width */
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Employee</h1>
        
        <!-- Display the message if set -->
        <?php if (isset($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        
        <form action="" method="POST">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="job_title">Job Title:</label>
            <input type="text" name="job_title">

            <label for="salary">Salary:</label>
            <input type="number" step="0.01" name="salary">

            <input type="submit" value="Create Employee">
        </form>

        <!-- Button to redirect to read.php -->
        <a href="2.) read.php" class="button">View Employees</a>
    </div>
</body>
</html>

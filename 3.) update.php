<?php
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $job_title = $_POST['job_title'];
    $salary = $_POST['salary'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE employees SET first_name = ?, last_name = ?, job_title = ?, salary = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $first_name, $last_name, $job_title, $salary, $id);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        $message = "Employee updated successfully.";
    } else {
        $message = "Error updating employee: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Fetch the employee data to pre-fill the form
$employeeId = $_GET['id'] ?? null; // Use null coalescing operator for safety

if ($employeeId) {
    $stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
    $stmt->bind_param("i", $employeeId);
    $stmt->execute();
    $result = $stmt->get_result();
    $employee = $result->fetch_assoc();

    // Check if employee was found
    if (!$employee) {
        $message = "No employee found with the given ID.";
    }

    // Close the statement
    $stmt->close();
} else {
    $message = "No employee ID provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
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
        .button-container {
            text-align: center;
            margin-top: 15px;
        }
        .message {
            text-align: center;
            color: #333;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Employee</h1>
        
        <!-- Display the message if set -->
        <?php if (isset($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($employee['id'] ?? '') ?>">

            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" value="<?= htmlspecialchars($employee['first_name'] ?? '') ?>" required><br>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" value="<?= htmlspecialchars($employee['last_name'] ?? '') ?>" required><br>

            <label for="job_title">Job Title:</label>
            <input type="text" name="job_title" value="<?= htmlspecialchars($employee['job_title'] ?? '') ?>"><br>

            <label for="salary">Salary:</label>
            <input type="number" step="0.01" name="salary" value="<?= htmlspecialchars($employee['salary'] ?? '') ?>"><br>

            <input type="submit" value="Update Employee">
        </form>

        <!-- Button to lead to read.php -->
        <div class="button-container">
            <a href="2.) read.php"><button>View Employee List</button></a>
        </div>
    </div>
</body>
</html>

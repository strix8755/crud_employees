<?php
include 'db.php';

// Query the database for employees
$result = $conn->query("SELECT * FROM employees");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .message {
            text-align: center;
            color: #333;
            margin-top: 15px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .button-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .button-container a, .button-container form {
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Employee List</h1>

        <div class="button-container">
            <a href="1.) create.php"><button>Add Employee</button></a>
            <a href="4.) delete.php"><button>Delete Employee</button></a>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Job Title</th>
                        <th>Salary</th>
                        <th>Actions</th> <!-- Added Actions column -->
                    </tr>
                </thead>
                <tbody>
                    <?php while ($employee = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $employee['id'] ?></td>
                            <td><?= $employee['first_name'] ?></td>
                            <td><?= $employee['last_name'] ?></td>
                            <td><?= $employee['email'] ?></td>
                            <td><?= $employee['job_title'] ?></td>
                            <td><?= number_format($employee['salary'], 2) ?></td>
                            <td>
                                <!-- Link to the update page for each employee -->
                                <a href="3.) update.php?id=<?= $employee['id'] ?>"><button>Update</button></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="message">No employees found.</p>
        <?php endif; ?>

        <!-- Close the database connection -->
        <?php $conn->close(); ?>
    </div>
</body>
</html>

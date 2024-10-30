<?php
include 'db.php';

$message = ""; // Initialize message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Prepare the DELETE statement
    $sql = "DELETE FROM employees WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->execute([$id]);
        if ($stmt->rowCount() > 0) {
            $message = "Employee deleted successfully.";
        } else {
            $message = "Error: Employee not found.";
        }
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Fetch all employees for the dropdown
$result = $conn->query("SELECT * FROM employees");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Employee</title>
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
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        form label {
            display: block;
            margin-top: 10px;
            color: #555;
        }
        form select {
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
            margin-top: 15px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        form input[type="submit"]:hover {
            background-color: #c82333;
        }
        .message {
            text-align: center;
            color: #333;
            margin-top: 15px;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button-container a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .button-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete Employee</h1>

        <!-- Display the message if set -->
        <?php if (!empty($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="id">Select Employee to Delete:</label>
            <select name="id" required>
                <option value="">-- Select an Employee --</option>
                <?php while ($employee = $result->fetch_assoc()): ?>
                    <option value="<?= $employee['id'] ?>"><?= $employee['first_name'] ?> <?= $employee['last_name'] ?> - <?= $employee['job_title'] ?></option>
                <?php endwhile; ?>
            </select>
            <p>Are you sure you want to delete this employee?</p>
            <input type="submit" value="Delete Employee">
        </form>

        <div class="button-container">
            <a href="2.) read.php">Back to Employee List</a>
        </div>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

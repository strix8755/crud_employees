<?php
$host = '127.0.0.1'; // Use 127.0.0.1 for compatibility in Termux environments
$db = 'employee_management';
$user = 'root';
$pass = '';
$socket = '/data/data/com.termux/files/usr/var/run/mysqld/mysqld.sock'; // MySQL socket path for Termux

// Create a MySQLi connection
$conn = new mysqli($host, $user, $pass, $db, null, $socket);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

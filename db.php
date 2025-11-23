<?php
$servername = "localhost";
$username = "root";
$password = ""; // Default XAMPP password
$dbname = "bookstore_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start(); // Starts session for every page including this file
?>

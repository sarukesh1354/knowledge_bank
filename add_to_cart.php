<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];

    // Create cart array if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Add book_id to session cart if not already there
    if (!in_array($book_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $book_id;
    }
    
    // Redirect back to previous page
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>

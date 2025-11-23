<?php
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Search for the ID in the array and remove it
    if (($key = array_search($id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
    }
}
header("Location: cart.php");
?>

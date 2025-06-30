<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../helpers/db_product_methods.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $productID = $_POST['productID'] ?? null;
    $userID = $_SESSION['userID'] ?? null;

    if (empty($title) || empty($description) || empty($price)) {
        $error_message = "All fields are required.";
    } elseif (!is_numeric($price) || $price < 0) {
        $error_message = "Price must be a valid positive number.";
    } elseif (!$userID) {
        $error_message = "User not authenticated. Please try logging in again";
    }

    try {
        if ($productID) {
            update_product($productID, $title, $userID, $description, $price);
            $_SESSION['message'] = "Product updated successfully!";
        } else {
            insert_product($title, $userID, $description, $price);
            $_SESSION['message'] = "Product added successfully!";
            echo "<script>console.log($title);</script>";
        }
        header("Location: ../manage-products.php");
        exit;
    } catch (PDOException $e) {
        $error_message = "Database error: " . $e->getMessage();
    }
}

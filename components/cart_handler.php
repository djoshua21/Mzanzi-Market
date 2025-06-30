<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (!isset($_SESSION['userID'])) {
        header("Location: ../?login=true");
        exit();
    }
}
require_once __DIR__ . '/../helpers/db_cart_methods.php';

$userID = $_SESSION['userID'] ?? null;
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_POST['method'] == 'add') {
        add_to_cart($userID, $_POST['productID']);
    } elseif ($_POST['method'] == 'remove') {
        remove_from_cart($userID, $_POST['productID']);
    }

    header('Location: ../cart.php');
    exit;
}

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../helpers/db_order_methods.php';
require_once __DIR__ . '/../helpers/db_cart_methods.php';

$userID = $_SESSION['userID'] ?? null;


echo $_POST['total'];
if ($_SERVER["REQUEST_METHOD"] === "POST" && $userID) {


    add_order($userID, $_POST['total']);
    clear_cart($userID);


    header('Location: ../cart.php');
}

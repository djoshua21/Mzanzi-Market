<?php

require_once 'db_conn.php';

function get_cart($userID)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM cart WHERE userID = :userID");
    $stmt->execute([
        ':userID' => $userID
    ]);


    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $productIDs = [];

    foreach ($cart_items as $c) {
        $productIDs[] = $c['productID'];
    }


    if (!empty($productIDs)) {

        $placeholders = implode(',', array_fill(0, count($productIDs), '?'));

        $stmt = $pdo->prepare("SELECT * FROM products WHERE productID IN ($placeholders)");
        $stmt->execute($productIDs);

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    } else {
        return [];
    }
}

function add_to_cart($userID, $productID)
{

    global $pdo;
    $stmt = $pdo->prepare("
        INSERT INTO cart (userID, productID)
        VALUES (:userID, :productID)
    ");

    $stmt->execute([
        ':userID' => $userID,
        ':productID' => $productID
    ]);

    header('Location: ../cart.php');
}
function remove_from_cart($userID, $productID)
{

    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM cart WHERE userID = :userID AND productID = :productID");
    $stmt->execute([
        ':userID' => $userID,
        ':productID' => $productID
    ]);
}

function clear_cart($userID)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM cart WHERE userID = :userID");
    $stmt->execute([
        ':userID' => $userID
    ]);
}

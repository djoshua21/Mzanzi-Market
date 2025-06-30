<?php

require_once 'db_conn.php';


function add_order($userID, $total)
{
    global $pdo;

    $stmt = $pdo->prepare("
        INSERT INTO orders (userID, orderTotal)
        VALUES (:userID, :orderTotal)
    ");

    $stmt->execute([
        ':userID' => $userID,
        ':orderTotal' => $total
    ]);
}

function get_user_orders($userID)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM orders WHERE userID = :userID ORDER BY orderDate DESC");
    $stmt->execute([':userID' => $userID]);

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $orders ?? [];
}

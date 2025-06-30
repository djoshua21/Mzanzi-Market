<?php

require_once 'db_conn.php';

function insert_product($title, $userID, $description, $price)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO products (title, userID, description, price)
                           VALUES (:title, :userID, :description, :price)");
    $stmt->execute([
        ':title' => $title,
        ':userID' => $userID,
        ':description' => $description,
        ':price' => $price
    ]);
};

function update_product($productID, $title, $userID, $description, $price)
{

    global $pdo;
    $stmt = $pdo->prepare("UPDATE products 
                       SET title = :title, 
                           description = :description, 
                           price = :price 
                       WHERE productID = :productID AND userID = :userID");

    $stmt->execute([
        ':title' => $title,
        ':userID' => $userID,
        ':description' => $description,
        ':price' => $price,
        ':productID' => $productID
    ]);
};


function delete_product($productID)
{

    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM products WHERE productID = :productID");
    $stmt->execute([
        ':productID' => $productID
    ]);


};

function get_product($productID)
{

    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM products WHERE productID = :productID");
    $stmt->execute([':productID' => $productID]);


    $product = $stmt->fetch(PDO::FETCH_ASSOC);


    return $product;
};

function get_all_products(?string $search = null, ?string $min = null, ?string $max = null)
{
    global $pdo;

    $w = '';
    $isSecondary = false;

    if (isset($search) or isset($min) or isset($max)) {
        $w = $w . 'WHERE ';
    }

    if (isset($search) and $search != '') {
        if ($isSecondary) {
            $w = $w . ' AND title LIKE ' . $pdo->quote('%' . $search . '%');
        } else {
            $w = $w . ' title LIKE ' . $pdo->quote('%' . $search . '%');
            $isSecondary = true;
        }
    }

    if (isset($min)) {
        if ($isSecondary) {
            $w = $w . ' AND price >= ' . $min;
        } else {
            $w = $w . ' price >= ' . $min;
            $isSecondary = true;
        }
    }

    if (isset($max)) {
        if ($isSecondary) {
            $w = $w . ' AND price <= ' . $max;
        } else {
            $w = $w . ' price <= ' . $max;
            $isSecondary = true;
        }
    }

    // $query = "SELECT * FROM products $w LIMIT 16 OFFSET 0";
    $query = "SELECT * FROM products $w LIMIT 100";
    $result = $pdo->query($query);

    $products = [];

    while ($row = $result->fetch()) {

        $products[] = [
            $row['productID'], //0
            $row['title'], //1
            $row['description'], //2
            $row['price'], //3
            $row['rating'], //4
            $row['userID'], //5
        ];
    }
    return $products;
};

function get_user_products($userID)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM products WHERE userID = :userID");
    $stmt->execute([':userID' => $userID]);


    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);


    return $products;
};

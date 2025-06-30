<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();

    $userID = $_SESSION['userID'] ?? '';

    if ($userID == '') {
        header('Location: /?login=true');
        exit;
    }
}

require_once 'helpers/db_order_methods.php';
require_once 'helpers/db_product_methods.php';

$products = get_user_products($userID);
$orders = get_user_orders($userID);

$orderCount = count($orders);
$productCount = count($products);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mzansi Market</title>
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/search.css">
    <link rel="stylesheet" href="styles/dashboard.css">




</head>


<body id="body">

    <!-- Header -->
    <?php
    require 'components/header.php'
    ?>
    <!-- <div class="bg" id=bg> -->
    <div class="dashboard" id="bg">
        <h2>User Dashboard</h2>

        <div class="totals">
            <div class="box">
                <strong>Total Orders</strong>
                <p><?= $orderCount ?></p>
            </div>

            <div class="box">
                <strong>Products Listed</strong>
                <p><?= $productCount ?></p>
            </div>
        </div>

        <h3>Order History</h3>
        <?php if ($orderCount > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total (ZAR)</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['orderID']) ?></td>
                            <td>R<?= htmlspecialchars($order['orderTotal']) ?></td>
                            <td><?= htmlspecialchars($order['orderDate']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No orders yet.</p>
        <?php endif; ?>

        <h3>Products Listed</h3>
        <?php if ($productCount > 0): ?>
            <ul>
                <?php foreach ($products as $product): ?>
                    <li><?= htmlspecialchars($product['title']) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No products listed.</p>
        <?php endif; ?>

        <button class="confirm-button" onclick="openManageProducts()">Manage Products</button>
    </div>
    <!-- </div> -->

    <?php
    require 'components/search.php';
    require 'components/login.php';
    require 'components/signup.php';

    $show_signup_overlay = (isset($_GET['signup']));
    $show_login_overlay = (isset($_GET['login']));

    if ($show_signup_overlay) {

        echo "<script>
    openCard('signup_overlay');
    </script>";
    }

    if ($show_login_overlay) {

        echo "<script>
    openCard('login_overlay');
    </script>";
    }

    ?>
    <div class="footer">
        <p>&copy; 2025 Mzansi Market: "From Me To You."</p>
    </div>

    <script>
        function openManageProducts() {
            window.location.href = "/manage-products.php";
        }
    </script>
</body>

</html>
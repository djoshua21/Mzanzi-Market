<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();

    $user = $_SESSION['userID'] ?? '';

    if ($user == '') {
        header('Location: /?login=true');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mzansi Market</title>
    <link rel="stylesheet" href="/styles/cart.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/search.css">


</head>

<body id="body">

    <?php
    require_once __DIR__ . '/helpers/db_cart_methods.php';
    require_once __DIR__ . '/components/header.php';
    require_once __DIR__ . '/components/cart_handler.php';
    ?>
    <div class="bg" id=bg>
        <h2 style="text-decoration: underline; text-align: center;">Cart</h2>
        <?php

        $products = get_cart($_SESSION['userID']);

        if (count($products) == 0) {

            echo <<<_END
                <h2 style='text-align:center'>No products in cart</h2>
            _END;
        }
        $total = 0;

        foreach ($products as $p) {

            $productID = $p['productID'];
            $title = $p['title'];
            $price = $p['price'];
            $description = $p['description'];

            $total += $price;

            echo <<<_END
            <div class="product-card">
                <img id="p-image" class="product-image" src="resources/product-placeholder.png" alt="Product Image">
                <div>
                    <h3 id="p-title" class="product-title">$title</h3>
                    <p id="p-price" class="product-info">Price: R$price</p>
                    <p id="p-description" class="desc">$description</p>

                    <form id="removeCartForm" action="components/cart_handler.php" method="post">
                        <input type="hidden" id="productID" name="productID">
                        <input type="hidden" name="method" id="method" value="remove">
                    </form>
                    </div>
                <a id="p-remove" onclick="removeFromCart('$productID')" class="remove-item">Remove From Cart</a>
            </div>
            _END;
        }



        ?>
        <?php if (count($products) > 0): ?>
            <br>
            <div style="flex-direction: row;display: flex; margin:auto">

                <h2 style=" text-align: center; min-width: 200px;">Total: R<?php echo $total ?></h2>

                <button class="confirm-button" style="margin-left: 20px; " onclick="placeOrder()">Confirm Order</button>

            </div>
            <form id="placeOrderForm" action="components/order_handler.php" method="post">
                <input type="hidden" id="total" name="total" value="<?php echo $total ?>">
            </form>
        <?php endif; ?>

    </div>

    <?php
    require 'components/search.php';
    ?>

    <form action=""></form>

    <div class="footer">
        <p>&copy; 2025 Mzansi Market: "From Me To You."</p>
    </div>

    <script>
        function removeFromCart(productID) {
            document.getElementById('productID').value = productID;
            document.getElementById('removeCartForm').submit();
        }

        function placeOrder() {

            document.getElementById('placeOrderForm').submit();
        }
    </script>
</body>

</html>
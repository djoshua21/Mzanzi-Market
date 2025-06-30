<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mzansi Market</title>
    <link rel="stylesheet" href="/styles/details.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/search.css">


</head>

<body id="body">

    <?php
    require_once 'components/header.php';
    require_once 'helpers/db_product_methods.php';

    $productID = $_GET['productID'] ?? null;

    if (isset($productID)) {

        if ($productID) {
            $p = get_product($productID) ?? null;
        } else {
            echo "<h2 style='text-align:center'>Product with productID '$productID'</h2>";
        }
    } else {
        // header('Location: /');
    }

    ?>

    <div class="bg" id="bg">
        <?php if ($p): ?>
            <div class="product-card">


                <div style="margin: auto;">
                    <img id="p-image" class="product-image" src="resources/product-placeholder.png" alt="Product Image">
                </div>
                <div style="flex-grow: 1;">
                    <h2 id="p-title" class="product-title"><?php echo $p['title'] ?></h2>
                    <p id="p-price" class="product-info">Price: <?php echo $p['price'] ?></p>
                    <p id="p-seller" class="product-info">Seller Code: <?php echo $p['userID'] ?></p>
                    <p id="p-description" class="product-description"><?php echo $p['description'] ?></p>
                    <br>
                    <br>
                    <div style=" text-align: right; margin-top: auto;">
                        <form action="/components/cart_handler.php" id="addCartForm" method="post">
                            <input type="hidden" name="productID" id="productID">
                            <input type="hidden" name="method" id="method" value="add">
                        </form>
                        <button id="p-remove" onclick="addToCart('<?php echo $p['productID'] ?>')" class="add-item">Add to Cart</button>
                    </div>

                </div>


            </div>
        <?php else: echo "<h2 style='text-align:center'>Product with productID '$productID' does not exist.</h2>"; ?>

        <?php endif; ?>


    </div>

    <?php
    require 'components/search.php';
    ?>

    <div class="footer">
        <p>&copy; 2025 Mzansi Market: "From Me To You."</p>
    </div>

    <script>
        function addToCart(productID) {
            document.getElementById('productID').value = productID;
            document.getElementById('addCartForm').submit();
        }
        
    </script>
</body>

</html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();

    $user = $_SESSION['userID'] ?? '';

    if ($user == '') {
        header('Location: /?login=true');
    }
}

require 'helpers/db_product_methods.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mzansi Market</title>

    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/search.css">
    <link rel="stylesheet" href="styles/manage-products.css">


</head>

<body id="body">
    <?php
    require_once 'components/header.php'
    ?>





    <div class="bg" id=bg>

        <h2 style="text-decoration: underline; text-align: center;">Manage Products</h2>
        <button id="p-add" onclick="addProduct()" class="add-button">Add Product</button>

        <?php

        require_once 'helpers/db_product_methods.php';

        $products = get_user_products($_SESSION['userID']);

        if (count($products) == 0) {

            echo <<<_END
                <h2 style='text-align:center'>No ProductsListed</h2>
            _END;
        }


        foreach ($products as $p) {

            $productID = $p['productID'];
            $title = $p['title'];
            $price = $p['price'];
            $description = $p['description'];

            echo <<<_END
                <div class="product-card">
                    <img id="p-image" class="product-image" src="resources/product-placeholder.png" alt="Product Image">
                    <div>
                        <h3 id="p-title" class="product-title">$title</h3>
                        <p id="p-price" class="product-info">Price: R$price</p>
                        <p id="p-description" class="desc">$description</p>
                    </div>
                    <div style="display: grid; grid-template-rows: 1fr; gap: 10px;">
                        <button id="p-edit" onclick="editProduct('$productID', '$title', '$price', '$description');" class="edit-button">Edit Product</button>
                        <form method="post" id="remove">
                            <input type="hidden" id="prodID" name="prodID" value="$productID">
                            </form>
                        <button type="submit" name="btn-remove" id="p-remove" onclick="deleteProduct()" class="remove-button">Remove Product</input>
                    </div>
                </div>
            _END;
        }


        if (isset($_POST['prodID'])) {
            delete_product($_POST['prodID']);
            unset($_POST['prodID']);
            header('Location: /manage-products.php');
        }

        ?>

    </div>

    <?php
    require 'components/product.php';
    require 'components/search.php';

    ?>

    <div class="footer">
        <p>&copy; 2025 Mzansi Market: "From Me To You."</p>
    </div>
</body>
<script>
    function deleteProduct() {
        document.getElementById('remove').submit();

    }

    function editProduct(productID, title, price, description) {
        document.getElementById('heading').textContent = 'Edit Product';


        document.getElementById('product-productID').value = productID;
        document.getElementById('product-title').value = title;
        document.getElementById('product-price').value = price;
        document.getElementById('product-description').value = description;

        openCard('product_overlay');
    }

    function addProduct() {
        document.getElementById('heading').textContent = 'Add Product';


        document.getElementById('product-productID').value = '';
        document.getElementById('product-title').value = '';
        document.getElementById('product-price').value = '';
        document.getElementById('product-description').value = '';


        openCard('product_overlay');
    }
</script>

</html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}
$show_signup_overlay = isset($_GET['signup']);
$signup_success = $_GET['signup'] === 'success';
$signup_error = $_SESSION['signup_error'] ?? '';
unset($_SESSION['signup_error']);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mzansi Market</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/search.css">


</head>


<body id="body">

    <!-- Header -->
    <?php
    require 'components/header.php'
    ?>



    <div id="bg" class="bg">

        <?php

        require_once 'helpers/db_product_methods.php';

        if (isset($_GET['search'])) {

            $products = get_all_products(
                search: $_GET['search'],
                min: $_GET['min-price'],
                max: $_GET['max-price'],
            );
        } else {

            $products = get_all_products();
        }

        if (count($products) == 0) {

            echo <<<_END
                <h2 style='text-align:center'>No Products meeting search criteria</h2>
            _END;
        }

        foreach ($products as $p) {
            echo <<<_END
                <div class="product-card">
                    <img id="p-image" class="product-image" src="resources/product-placeholder.png" alt="Product Image">
                    <h3 id="p-title" class="product-title">$p[1]</h3>
                    <p id="p-price" class="info">Price: R$p[3]</p>
                    <a id="p-add" href="/details.php?productID=$p[0]" class="product-button">See Details</a>
                </div>
            _END;
        }
        ?>

    </div>

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
    <!-- todo: create a next and previous page button based on the total number of results -->
    <div class="footer">
        <p>&copy; 2025 Mzansi Market: "From Me To You."</p>
    </div>
</body>

</html>
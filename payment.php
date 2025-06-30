<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mzansi Market</title>
    <link rel="stylesheet" href="/styles/payment.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/search.css">


</head>

<body id="body">

    <?php
    require 'components/header.php'
    ?>

    <div class="bg" id="bg">

        <h2 style="text-align: center;">Complete payment details to confirm order.</h2>

        <form action="" class="form-card">
            <label for="c-holder">Name on Card</label>
            <input type="text" name="card-holder" id="c-holder">
            <br>

            <label for="c-number">Card Number</label>
            <input type="number" name="card-number" id="c-number">
            <br>

            <label for="c-date">Expiry Date</label>
            <input type="date" name="expiry-date" id="c-date">
            <br>

            <label for="c-cvv">CVV</label>
            <input type="number" name="cvv" id="c-cvv">

            <h3 class="total" id="c-total">Total: R564</h3>

            <input type="submit" value="Pay" class="pay">
        </form>

    </div>

    <?php
    require 'components/search.php';
    ?>

    <div class="footer">
        <p>&copy; 2025 Mzansi Market: "From Me To You."</p>
    </div>
</body>

</html>
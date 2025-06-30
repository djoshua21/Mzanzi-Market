<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error_message = $_SESSION['product_error'] ?? '';
unset($_SESSION['product_error']);

?>


<div id="product_overlay" class="overlay">

    <form action="components/product_handler.php" class="login-card" method="POST" onclick="event.stopPropagation();">
        <input type="hidden" id=product-productID name=productID>

        <div style="display: inline-flex; padding-bottom: 10px; justify-content: space-between;">

            <h2 id="heading" style="text-align: center; margin: 0px;text-decoration: underline;"></h2>
            <img class="ico-small" onclick="closeCard('product_overlay')" src="resources/x-symbol.svg" alt="close">
        </div>


        <label for="title">Product Title</label>
        <input type="text" id="product-title" name="title" class="text-box" maxlength="200" required>

        <label for="description">Description</label>
        <textarea id="product-description" name="description" rows="4" class="text-box" required></textarea>

        <label for="price">Price (ZAR)</label>
        <input type="text" id="product-price" name="price" class="text-box" inputmode="numeric" pattern="\d*"
            oninput="this.value = this.value.replace(/\D/g, '')" maxlength="5" required />


        <button type="submit" class="confirm-button">Confirm</button>

        <?php if ($error_message): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
    </form>

</div>
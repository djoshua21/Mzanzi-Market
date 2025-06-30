<?php
if (session_status() === PHP_SESSION_NONE) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

$error_message = $_SESSION['login_error'] ?? '';

unset($_SESSION['login_error']);
?>

<div id="login_overlay" class="overlay">



    <form action="components/login_handler.php" class="login-card" method="POST" onclick="event.stopPropagation();">


        <div style="display: inline-flex; padding: 10px; justify-content: space-between;">
            <h2 style="text-align: center; margin: 0px;text-decoration: underline;">Login</h2>
            <img class="ico-small" onclick="closeCard('login_overlay')" src="resources/x-symbol.svg" alt="close">
        </div>
        <br>
        <input type="email" name="email" class="text-box" placeholder="Email Address"><br>
        <input type="password" name="password" class="text-box" required placeholder="Password"><br>
        <button type="submit" class="confirm-button">Login</button>

        <?php if ($error_message): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
    </form>

</div>
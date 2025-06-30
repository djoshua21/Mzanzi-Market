<?php
if (session_status() === PHP_SESSION_NONE) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

?>


<div id="signup_overlay" class="overlay">

    <form action="components/signup_handler.php" class="login-card" method="POST" onclick="event.stopPropagation();">

        <div style="display: inline-flex; padding: 10px; justify-content: space-between;">
            <h2 style="text-align: center; margin: 0px;text-decoration: underline;">Sign Up</h2>
            <img class="ico-small" onclick="closeCard('signup_overlay')" src="resources/x-symbol.svg" alt="close">
        </div>
        <br>

        <input type="text" name="fullName" class="text-box" required placeholder="Full Name" autocomplete="full-name"><br>
        <input type="email" name="email" class="text-box" required placeholder="Email" autocomplete="email"><br>
        <input type="tel" name="phoneNumber" class="text-box" required placeholder="Phone Number" maxlength="10" autocomplete="phone-number"><br>
        <input type="password" name="password" class="text-box" required placeholder="Password" autocomplete="new-password"><br>
        <button type="submit" class="confirm-button">Sign Up</button>

        <?php if ($signup_success): ?>
            <p class="success">Signup successful! <a href="/?login=true">Login here</a></p>
        <?php elseif (!empty($signup_error)): ?>
            <p class="error"><?php echo htmlspecialchars($signup_error); ?></p>
        <?php endif; ?>
    </form>
</div>
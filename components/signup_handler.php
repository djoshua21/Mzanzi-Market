<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../helpers/db_conn.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = trim($_POST["fullName"]);
    $email = trim($_POST["email"]);
    $phoneNumber = trim($_POST["phoneNumber"]);
    $password = $_POST["password"];

    if (empty($fullName) || empty($email) || empty($phoneNumber) || empty($password)) {
        $_SESSION['signup_error'] = "Please fill in all fields.";
        header("Location: /?signup=true");
        exit;
    }

    $stmt = $pdo->prepare("SELECT userID FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['signup_error'] = "Email already exists.";
        header("Location: /?signup=true");
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (fullName, email, phoneNumber, password)
                           VALUES (:fullName, :email, :phoneNumber, :password)");
    $stmt->execute([
        ':fullName' => $fullName,
        ':email' => $email,
        ':phoneNumber' => $phoneNumber,
        ':password' => $hashed_password
    ]);
    $_SESSION['signup_error'] = "";
    $_SESSION['login_error'] = "";

    header("Location: /?signup=success");
    exit;
}

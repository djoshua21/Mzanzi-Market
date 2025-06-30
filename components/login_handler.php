<?php
session_start();

require '../helpers/db_conn.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]) ?? '';
    $password = $_POST["password"] ?? '';

    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = "Please fill in all fields.";
        header("Location: /?login=true");
        exit;
    }


    $stmt = $pdo->prepare("SELECT userID, password FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);


    if ($stmt->rowCount() == 0) {
        $_SESSION['login_error'] = "Email or password incorrect.";
        header("Location: /?login=true");
        exit;
    }

    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['userID'] = $user['userID'];
        $_SESSION['last_activity'] = time();
        $_SESSION['login_error'] = '';


        $redirect = $_GET['redirect'];

        if ($redirect == 'dashboard') {
            header("Location: dashboard.php");
        } {
            header("Location: /");
        }

        exit();
    } else {
        $_SESSION['login_error'] = "Email or password incorrect.";
        header("Location: /?login=true");
        exit();
    }
}

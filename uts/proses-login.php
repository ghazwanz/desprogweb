<?php
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: login.php");
        exit;
    }
    include "koneksi.php";
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $query = "SELECT * FROM \"user\" WHERE email='$email' and password='$password'";
    $result = pg_query($conn, $query);
    $cek = pg_num_rows($result);
    
    if ($cek > 0) {
        session_start();
        $_SESSION["email"] = $email;
        $_SESSION["status"] = 'login';
        header("Location: dashboard.php");
    } else {
        header("Location: login.php");
    }
?>
<?php
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: register.php");
        exit;
    }
    
    include "koneksi.php";
    
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    // Cek apakah email sudah terdaftar
    $check_query = "SELECT * FROM \"user\" WHERE email='$email'";
    $check_result = pg_query($conn, $check_query);
    
    if (pg_num_rows($check_result) > 0) {
        // Email sudah terdaftar
        header("Location: register.php?error=email_exists");
        exit;
    }
    
    // Insert user baru ke database
    $insert_query = "INSERT INTO \"user\" (email, password) VALUES ('$email', '$password')";
    $result = pg_query($conn, $insert_query);
    
    if ($result) {
        // Registrasi berhasil, redirect ke login dengan pesan sukses
        header("Location: login.php?registered=success");
        exit;
    } else {
        // Registrasi gagal
        header("Location: register.php?error=registration_failed");
        exit;
    }
?>

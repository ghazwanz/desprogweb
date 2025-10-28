<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "prakwebdb";

$connect = mysqli_connect($host, $username, $password, $database);

if (!$connect) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// $query = "CREATE TABLE user (
//     id INT PRIMARY KEY,
//     username VARCHAR(50) NOT NULL,
//     password VARCHAR(50) NOT NULL
// )";

// mysqli_query($connect, $query);

// $id = 1;
// $username = 'admin';
// $password = md5('123');

// $query = "INSERT INTO user (id, username, password) 
//             VALUES ('$id', '$username', '$password')";

// mysqli_query($connect, $query);
?>
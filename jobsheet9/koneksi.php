<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "prakwebdb";

$connect = mysqli_connect($host, $username, $password, $database);

if (!$connect) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$query = "CREATE TABLE user (
    id INT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
)";

mysqli_query($connect, $query);

?>
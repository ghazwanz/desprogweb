<?php
$host = 'localhost';
$port = '5432';
$dbname = 'clickup';
$user = 'postgres';
$pass = 'zqwea123__';

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");
if (!$conn) {
    die('Koneksi gagal: ' . pg_last_error());
}
?>
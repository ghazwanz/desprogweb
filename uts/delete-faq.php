<?php
include "./koneksi.php";

if (!isset($_GET['delete_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ./manage-faq.php?error=invalid-delete-process');
    exit;
}

$delete_id = (int)$_GET['delete_id'];
$sql = 'DELETE FROM "table_faq" WHERE id = $1';
$result = pg_query_params($conn, $sql, [$delete_id]);

if ($result && pg_affected_rows($result) > 0) {
    header('Location: ./manage-faq.php?msg=deleted');
}else{
    header('Location: ./manage-faq.php?error=delete-failed');
}

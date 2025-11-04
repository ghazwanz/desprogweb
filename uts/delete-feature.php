<?php
include "./koneksi.php";

if (isset($_POST['id']) || isset($_GET['delete_id'])) {
    
    // Ambil ID baik dari GET (untuk alur form) atau POST (jika form di-submit)
    $delete_id = isset($_GET['delete_id']) ? (int)$_GET['delete_id'] : (int)$_POST['id'];

    if ($delete_id > 0) {
        
        // (Opsional) Hapus file gambar dari server terlebih dahulu
        $sql_get_img = 'SELECT image_file_name FROM "table_feature" WHERE id = $1';
        $res_img = pg_query_params($conn, $sql_get_img, [$delete_id]);
        
        if ($res_img && pg_num_rows($res_img) > 0) {
            $img_file = pg_fetch_assoc($res_img)['image_file_name'];
            $file_path = './img/' . $img_file;
            
            // Hapus file jika ada dan tidak kosong
            if (!empty($img_file) && file_exists($file_path)) {
                unlink($file_path);
            }
        }

        // Hapus data dari database
        $sql = 'DELETE FROM "table_feature" WHERE id = $1';
        $result = pg_query_params($conn, $sql, [$delete_id]);
        
        if ($result) {
            header('Location: ./manage-feature.php?msg=deleted');
            exit;
        } else {
            header('Location: ./manage-feature.php?msg=error');
            exit;
        }

    } else {
        // ID tidak valid
        header('Location: ./manage-feature.php?msg=error');
        exit;
    }

} else {
    // Tidak ada ID yang dikirim
    header('Location: ./manage-feature.php');
    exit;
}
?>
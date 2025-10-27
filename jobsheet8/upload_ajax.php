<?php
if (isset($_FILES['file']['name'][0]) && $_FILES['file']['name'][0] != "") {
    $errors = array();
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $maxSize = 2097152;
    $totalFiles = count($_FILES['file']['name']);
    $successMessages = "";

    for ($i = 0; $i < $totalFiles; $i++) {
        $file_name = $_FILES['file']['name'][$i];
        $file_size = $_FILES['file']['size'][$i];
        $file_tmp = $_FILES['file']['tmp_name'][$i];
        @$file_ext = strtolower(end(explode('.', $file_name)));

        $currentErrors = array();

        if (in_array($file_ext, $allowedExtensions) === false) {
            $currentErrors[] = "Ekstensi file $file_name tidak diizinkan (hanya JPG, PNG, GIF).";
        }

        if ($file_size > $maxSize) {
            $currentErrors[] = "Ukuran file $file_name tidak boleh lebih dari 2 MB.";
        }

        if (empty($currentErrors)) {
            if (move_uploaded_file($file_tmp, "documents/" . $file_name)) {
                $successMessages .= "File $file_name berhasil diunggah.<br>";
            } else {
                $errors[] = "Gagal memindahkan file $file_name.";
            }
        } else {
            $errors = array_merge($errors, $currentErrors);
        }
    }

    echo $successMessages;
    if (!empty($errors)) {
        echo implode("<br>", $errors);
    }
} else {
    echo "Tidak ada file yang dipilih.";
}
?>
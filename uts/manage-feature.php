<?php

session_start();

if ($_SESSION['status'] !== 'login') {
    header("Location: login.php");
}

include "./koneksi.php";

// Handle Form Submission (Create/Update)
$errors = [];
$success_message = '';
$id = null;
$feature_title = '';
$feature_desc = '';
$feature_img = ''; // Akan berisi nama file gambar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feature_title = trim($_POST['feature_title']);
    $feature_desc = trim($_POST['feature_desc']);
    
    // Inisialisasi nama file gambar
    $feature_img_name = '';
    
    // 1. Jika ini adalah UPDATE, ambil nama file gambar yang ada saat ini
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $sql_current_img = 'SELECT image_file_name FROM "table_feature" WHERE id = $1';
        $res_current_img = pg_query_params($conn, $sql_current_img, [$id]);
        if ($res_current_img && pg_num_rows($res_current_img) > 0) {
            $feature_img_name = pg_fetch_assoc($res_current_img)['image_file_name'];
        }
    }

    // 2. Cek apakah ada file baru yang di-upload
    if (isset($_FILES['feature_img']) && $_FILES['feature_img']['error'] == 0) {
        $upload_dir = './img/';
        // Pastikan nama file unik atau aman
        $new_file_name = time() . '_' . basename($_FILES['feature_img']['name']);
        $target_file = $upload_dir . $new_file_name;

        // (Anda bisa menambahkan validasi file di sini, misal: cek tipe, ukuran)
        
        if (move_uploaded_file($_FILES['feature_img']['tmp_name'], $target_file)) {
            if (!empty($new_file_name) && file_exists("$upload_dir"."$feature_img_name")) {
                unlink("$upload_dir"."$feature_img_name");
            }
            $feature_img_name = $new_file_name;
        } else {
            $errors[] = "Gagal meng-upload gambar.";
        }
    }
    // === AKHIR LOGIKA IMAGE UPLOAD ===

    // Validation
    if (empty($feature_title)) {
        $errors[] = "Feature title is required";
    }
    if (empty($feature_desc)) {
        $errors[] = "Feature description is required";
    }
    
    if (empty($errors)) {
        if (isset($_GET['id'])) {
            // Update existing Feature
            $id = (int)$_GET['id'];
            $sql = 'UPDATE "table_feature" SET feature_title = $1, feature_desc = $2, image_file_name = $3 WHERE id = $4';
            $result = pg_query_params($conn, $sql, [$feature_title, $feature_desc, $feature_img_name, $id]);
            
            if ($result) {
                header('Location: ./manage-feature.php?msg=updated');
                exit;
            }
        } else {
            // Insert new Feature
            // PERBAIKAN: Tambahkan 'image_file_name' ke query INSERT
            $sql = 'INSERT INTO "table_feature" (feature_title, feature_desc, image_file_name) VALUES ($1, $2, $3)';
            $result = pg_query_params($conn, $sql, [$feature_title, $feature_desc, $feature_img_name]);
            
            if ($result) {
                header('Location: ./manage-feature.php?msg=created');
                exit;
            }
        }
    }
}

// Load Feature data if editing
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = 'SELECT * FROM "table_feature" WHERE id = $1';
    $result = pg_query_params($conn, $sql, [$id]);
    
    if ($result && pg_num_rows($result) > 0) {
        $feature = pg_fetch_assoc($result);
        $feature_title = $feature['feature_title'];
        $feature_desc = $feature['feature_desc'];
        $feature_img = $feature['image_file_name'];
    } else {
        $errors[] = "Feature not found";
    }
}

// Get all Features
$sqlFeature = 'SELECT * FROM "table_feature" ORDER BY id DESC';
$resultFeature = pg_query($conn, $sqlFeature);
$countFeature = pg_num_rows($resultFeature);
$rowFeature = pg_fetch_all($resultFeature) ?: [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Feature - Dashboard</title>
    <script src="jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="styleBoard.css">
</head>

<body>
    <?php include "./sidebar.php" ?>
    <div class="container">
        <main class="main-content">
            <div class="header">
                <h1>Manage Feature Content</h1>
                <div class="header-info">
                    <div class="user-avatar">JD</div>
                </div>
            </div>

            <?php if (isset($_GET['msg'])): ?>
                <div class="alert alert-success">
                    <?php 
                    switch($_GET['msg']) {
                        case 'created':
                            echo '✓ Feature successfully created!';
                            break;
                        case 'updated':
                            echo '✓ Feature successfully updated!';
                            break;
                        case 'deleted':
                            echo '✓ Feature successfully deleted!';
                            break;
                    }
                    ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <?php foreach($errors as $error): ?>
                        <p>⚠ <?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="task-list-section">                
                <h2>Feature Content List</h2>
                <p>Total Feature: <?php echo $countFeature ?></p>
                <table class="task-list">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Feature Title</th>
                            <th>Feature Description</th>
                            <th>Feature Image</th>
                            <th colspan="2" style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($rowFeature)): ?>
                            <tr class="empty-state">
                                <td colspan="5">
                                    <p>📝 There is no Feature data right now. Create a new one!</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($rowFeature as $index => $feature): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($feature['feature_title']); ?></td>
                                    <td><?php echo htmlspecialchars($feature['feature_desc']); ?></td>
                                    <td>
                                        <?php if (!empty($feature["image_file_name"])): ?>
                                            <img src="<?= "./img/" . htmlspecialchars($feature["image_file_name"]); ?>" width="100" alt="">
                                        <?php else: ?>
                                            No Image
                                        <?php endif; ?>
                                    </td>
                                    <td class="action-buttons">
                                        <a class="button-primary" href="?id=<?php echo urlencode($feature['id']); ?>">
                                            Edit
                                        </a>

                                        <button class="button-danger" onclick="if(confirm('Hapus data ini?')) { 
                                        document.getElementById('deleteForm<?= $feature['id'] ?>').submit(); 
                                        }">Hapus</button>

                                        <form id="deleteForm<?= $feature['id'] ?>" action="delete-feature.php?delete_id=<?php echo urlencode($feature['id']); ?>" method="post" style="display:none;">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($feature['id']) ?>">
                                        </form>
                                        </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <button class="button-primary" id="create-feature">Create New Feature</button>
            </div>

            <div class="task-list-section feature-form" id="feature-form">
                <h2><?php echo isset($id) ? 'Edit Feature' : 'Create Feature'; ?></h2>

                <form method="POST" action="<?php echo isset($id) ? './manage-feature.php?id=' . urlencode($id) : './manage-feature.php'; ?>" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="feature_title" class="form-label">Feature Title</label>
                        <input type="text" 
                               class="form-input" 
                               id="feature_title" 
                               name="feature_title"
                               value="<?php echo htmlspecialchars($feature_title); ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="feature_desc" class="form-label">Feature Description</label>
                        <textarea class="form-input" 
                                  id="feature_desc" 
                                  name="feature_desc"
                                  rows="5" 
                                  required><?php echo htmlspecialchars($feature_desc); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="feature_img" class="form-label">Feature Image</label>
                        <?php if (isset($id) && !empty($feature_img)): ?>
                            <p>Current Image: <img src="./img/<?php echo htmlspecialchars($feature_img); ?>" width="100" alt=""></p>
                            <p>Upload new file to replace:</p>
                        <?php endif; ?>
                        <input type="file" class="form-input" name="feature_img" id="feature_img">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="button-primary">
                            <?php echo isset($id) ? 'Update Feature' : 'Create Feature'; ?>
                        </button>
                        <button type="button" class="button-danger" id="cancel-feature">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
    
    <script src="./script.js"></script>
</body>

</html>
<?php
session_start();

if ($_SESSION['status'] !== 'login') {
    header("Location: login.php");
}

include "./koneksi.php";

// Handle Delete Request
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $sql = 'DELETE FROM "table_faq" WHERE id = $1';
    $result = pg_query_params($conn, $sql, [$delete_id]);
    
    if ($result) {
        header('Location: ./manage-faq.php?msg=deleted');
        exit;
    }
}

// Handle Form Submission (Create/Update)
$errors = [];
$success_message = '';
$id = null;
$faq_title = '';
$faq_desc = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $faq_title = trim($_POST['faq_title']);
    $faq_desc = trim($_POST['faq_desc']);
    
    // Validation
    if (empty($faq_title)) {
        $errors[] = "FAQ title is required";
    }
    if (empty($faq_desc)) {
        $errors[] = "FAQ description is required";
    }
    
    if (empty($errors)) {
        if (isset($_GET['id'])) {
            // Update existing FAQ
            $id = (int)$_GET['id'];
            $sql = 'UPDATE "table_faq" SET faq_title = $1, faq_desc = $2 WHERE id = $3';
            $result = pg_query_params($conn, $sql, [$faq_title, $faq_desc, $id]);
            
            if ($result) {
                header('Location: ./manage-faq.php?msg=updated');
                exit;
            }
        } else {
            // Insert new FAQ
            $sql = 'INSERT INTO "table_faq" (faq_title, faq_desc) VALUES ($1, $2)';
            $result = pg_query_params($conn, $sql, [$faq_title, $faq_desc]);
            
            if ($result) {
                header('Location: ./manage-faq.php?msg=created');
                exit;
            }
        }
    }
}

// Load FAQ data if editing
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = 'SELECT * FROM "table_faq" WHERE id = $1';
    $result = pg_query_params($conn, $sql, [$id]);
    
    if ($result && pg_num_rows($result) > 0) {
        $faq = pg_fetch_assoc($result);
        $faq_title = $faq['faq_title'];
        $faq_desc = $faq['faq_desc'];
    } else {
        $errors[] = "FAQ not found";
    }
}

// Get all FAQs
$sqlFaq = 'SELECT * FROM "table_faq" ORDER BY id DESC';
$resultFaq = pg_query($conn, $sqlFaq);
$countFaq = pg_num_rows($resultFaq);
$rowFaq = pg_fetch_all($resultFaq) ?: [];

if (isset($_GET["error"])) {
    $errors[] = $_GET["error"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage FAQ - Dashboard</title>
    <script src="jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="styleBoard.css">
</head>

<body>
    <?php include "./sidebar.php" ?>
    <div class="container">
        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Manage FAQ Content</h1>
                <div class="header-info">
                    <div class="user-avatar">JD</div>
                </div>
            </div>

            <!-- Success/Error Messages -->
            <?php if (isset($_GET['msg'])): ?>
                <div class="alert alert-success">
                    <?php 
                    switch($_GET['msg']) {
                        case 'created':
                            echo '✓ FAQ successfully created!';
                            break;
                        case 'updated':
                            echo '✓ FAQ successfully updated!';
                            break;
                        case 'deleted':
                            echo '✓ FAQ successfully deleted!';
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

            <!-- FAQ List Section -->
            <div class="task-list-section">
                
                <h2>FAQ Content List</h2>
                <p>Total FAQ: <?php echo $countFaq ?></p>
                <table class="task-list">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>FAQ Title</th>
                            <th>FAQ Description</th>
                            <th colspan="2" style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($rowFaq)): ?>
                            <tr class="empty-state">
                                <td colspan="5">
                                    <p>📝 There is no FAQ data right now. Create a new one!</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($rowFaq as $index => $faq): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($faq['faq_title']); ?></td>
                                    <td><?php echo htmlspecialchars($faq['faq_desc']); ?></td>
                                    <td class="action-buttons">
                                        <a class="button-primary" href="?id=<?php echo urlencode($faq['id']); ?>">
                                            Edit
                                        </a>

                                        <button class="button-danger" onclick="if(confirm('Hapus data ini?')) { 
                                        document.getElementById('deleteForm<?= $faq['id'] ?>').submit(); 
                                        }">Hapus</button>

                                        <form id="deleteForm<?= $faq['id'] ?>" action="delete-faq.php?delete_id=<?php echo urlencode($faq['id']); ?>" method="post" style="display:none;">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($faq['id']) ?>">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <button class="button-primary" id="create-faq">Create New FAQ</button>
            </div>

            <!-- FAQ Form Section -->
            <div class="task-list-section faq-form" id="faq-form">
                <h2><?php echo isset($id) ? 'Edit FAQ' : 'Create FAQ'; ?></h2>

                <form method="POST" action="<?php isset($id)? './manage-faq?'.$id :'./manage-faq' ?>">

                    <div class="form-group">
                        <label for="faq_title" class="form-label">FAQ Title</label>
                        <input type="text" 
                               class="form-input" 
                               id="faq_title" 
                               name="faq_title"
                               value="<?php echo htmlspecialchars($faq_title); ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="faq_desc" class="form-label">FAQ Description</label>
                        <textarea class="form-input" 
                                  id="faq_desc" 
                                  name="faq_desc"
                                  rows="5" 
                                  required><?php echo htmlspecialchars($faq_desc); ?></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="button-primary">
                            <?php echo isset($id) ? 'Update FAQ' : 'Create FAQ'; ?>
                        </button>
                        <button type="button" class="button-danger" id="cancel-faq">
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
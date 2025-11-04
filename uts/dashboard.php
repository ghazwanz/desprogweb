<?php
session_start();

if ($_SESSION['status'] !== 'login') {
    header("Location: login.php");
}

include "./koneksi.php";

$sqlFeature = 'SELECT * FROM "table_feature" order by id desc';
$sqlFaq = 'SELECT * FROM "table_faq" order by id desc';

$resultFaq = pg_query($conn, $sqlFaq);
$resultFeature = pg_query($conn, $sqlFeature);

$countFaq = pg_num_rows($resultFaq);
$countFeature = pg_num_rows($resultFeature);

$sqlFeature = 'SELECT * FROM "table_feature" order by id desc limit 3';
$sqlFaq = 'SELECT * FROM "table_faq" order by id desc limit 3';

$resultFaq = pg_query($conn, $sqlFaq);
$resultFeature = pg_query($conn, $sqlFeature);

$rowFaq = pg_fetch_all($resultFaq) ?: [];
$rowFeature = pg_fetch_all($resultFeature) ?: [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List Dashboard</title>
    <script src="jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="styleBoard.css">
</head>

<body>
    <?php include "./sidebar.php" ?>
    <div class="container">

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Hello, Admin</h1>
                <div class="header-info">
                    <div class="user-avatar">JD</div>
                </div>
            </div>

            <!-- Task Stats -->
            <div class="task-stats">
                <div class="stat-card">
                    <div class="stat-label">Total Faq Data</div>
                    <div class="stat-number"><?php echo $countFaq ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total Feature Data</div>
                    <div class="stat-number"><?php echo $countFeature ?></div>
                </div>
            </div>
            <div class="task-list-section">
                <h2>Recently Faq Content</h2>
                <?php include "./faq-content.php" ?>
            </div>
            <div class="task-list-section">
                <h2>Recently Feature Content</h2>
                <?php include "./feature-content.php" ?>
            </div>
        </main>
    </div>
    <script src="./script.js"></script>
</body>

</html>
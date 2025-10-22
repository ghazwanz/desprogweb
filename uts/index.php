<?php
// --- KONFIGURASI KONEKSI POSTGRESQL ---
$host = 'localhost';
$port = '5432';
$dbname = 'clickup';
$user = 'postgres';
$pass = 'zqwea123__';

// Membuat koneksi
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");
if (!$conn) {
    die('Koneksi gagal: ' . pg_last_error());
}

$sql = 'SELECT faq_title, faq_desc FROM "table_faq"
ORDER BY id desc';

$sqlFeature = 'SELECT feature_title, feature_desc, image_file_name FROM "table_feature"
ORDER BY id desc';

$result = pg_query($conn, $sql);

$resultFeature = pg_query($conn, $sqlFeature);

if (!$result || !$resultFeature) {
    die('Query gagal: ' . pg_last_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleClick.css">
    <title>Click Up Landing Page</title>
</head>

<body>
    <nav>
        <div class="nav-container container">
            <div class="logo">
                <a href="./">
                    <img src="img/logo-v3-clickup-light.svg" width="150" height="42" />
                </a>
            </div>
            <ul class="nav-links">
                <li><a href="#features">Features</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#faq">About</a></li>
                <li><a href="#faq">Contact</a></li>
            </ul>
            <a class="primary-button" href="./login.php">Login</a>
        </div>
    </nav>

    <main class="wrapper">
        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <div class="section-heading center">
                        <div class="badge">
                            Create teams in Organisation
                        </div>
                        <h1>The everything app, for work.</h1>
                        <p>One app for projects, knowledge, conversations, and more. Get more done faster—together.</p>
                    </div>

                    <div class="hero-buttons">
                        <button class="secondary-button">Contact Us</button>
                        <a class="primary-button" href="./login.php">Get Started</a>
                    </div>
                </div>

                <div class="hero-image">
                    <div class="image-placeholder">
                    </div>
                </div>
            </div>
        </section>
        <section class="integration section">
            <div class="container-md">
                <div class="integration-content">
                    <h3>Trusted by the world’s leading businesses</h3>
                    <div class="integration-widget">
                            <img src="img/cartoon-network.svg" width="135" height="35" />
                            <img src="img/wayfair.svg" width="135" height="35" />
                            <img src="img/chick-fil-a.svg" width="135" height="35" />
                            <img src="img/logitech.svg" width="135" height="35" />
                            <img src="img/zillow.svg" width="135" height="35" />
                    </div>
                </div>
            </div>
        </section>
        <section class="features section" id="features">
            <div class="container">
                <div class="features-content">
                    <div class="section-heading center">
                        <div class="badge">
                            Featured Tools
                        </div>
                        <h2>Everything your team is looking for</h2>
                        <p>ClickUp’s exceptional flexibility can handle any type of work. And we never stop innovating.
                        </p>
                    </div>
                    <div class="features-widget-wrap">
                        <?php $i=1; ?>
                        <?php while($row = pg_fetch_assoc($resultFeature)): ?>
                        <div class="features-widget">
                            <img src=<?= "./img/".htmlspecialchars($row["image_file_name"]); ?> alt="">
                            <div class="features-widget-content">
                                <div class="badge">
                                    Feature
                                </div>
                                <h3><?= htmlspecialchars($row["feature_title"]); ?></h3>
                                <p><?= htmlspecialchars($row["feature_desc"]); ?></p>
                                <button class="secondary-button">Learn More</button>
                            </div>
                        </div>
                        <?php $i++; endwhile; ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="faq section" id="faq">
            <div class="container-md">
                <div class="faq-content">
                    <div class="section-heading center">
                        <div class="badge">
                            FAQ
                        </div>
                        <h2>Frequently Asked Questions</h2>
                    </div>
                    <div class="faq-accordion-wrap">
                        <?php $i=1; ?>
                        <?php while($row = pg_fetch_assoc($result)): ?>
                        <div class="faq-accordion">
                            <div class="faq-accordion-item">
                                <div class="faq-accordion-title">
                                    <h4><?= htmlspecialchars($row["faq_title"]); ?></h4>
                                    <p style="color: #02015a">+</p>
                                </div>
                                <div class="faq-accordion-content" id="accordion-item-1">
                                    <p><?= htmlspecialchars($row["faq_desc"]); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php $i++; endwhile; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-header">
                    <h2>All-in-One Workspace for Your Ideas</h2>
                    <button class="primary-button-lg">Get Started</button>
                </div>
                <div class="footer-nav">
                    <div class="logo">
                        <a href="./">
                            <svg width="150" height="42">
                                <image xlink:href="img/logo-v3-clickup-light.svg" width="150" height="42" />
                            </svg>
                        </a>
                    </div>
                    <ul class="nav-links">
                        <li><a href="#features">Features</a></li>
                        <li><a href="#faq">FAQ</a></li>
                        <li><a href="#faq">About</a></li>
                        <li><a href="#faq">Contact</a></li>
                    </ul>
                    <ul class="social-links">
                        <li>
                            <a href="https://www.linkedin.com/company/clickup-app/" target="_blank">
                                <img src="./img/linkedIn.svg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/clickupprojectmanagement/" target="_blank">
                                <img src="./img/facebook.svg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/clickup/" target="_blank">
                                <img src="./img/instagram.svg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/clickup" target="_blank">
                                <img src="./img/x.svg" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="copyright">
                    © 2022 ClickUp
                </div>
            </div>
        </div>
    </footer>
    <script src="jquery-3.7.1.js"></script>
    <script src="script.js"></script>
</body>

</html>
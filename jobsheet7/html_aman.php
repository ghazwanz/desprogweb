<!DOCTYPE html>
<html>
<head>
    <title>HTML Injection</title>
</head>
<body>
    <h2>Form Input</h2>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="input">Input Teks:</label>
        <input type="text" name="input" id="input" required><br><br>
        <label for="input">Input Email:</label>
        <input type="text" name="email" id="email" required><br><br>
        <input type="submit" value="Submit">
    </form>
    
    <br><br>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input = $_POST['input'];
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

        $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email valid dan aman: " . htmlspecialchars($email) . "<br>";
        } else {
            echo "Email tidak valid. masukkan format email yang benar.<br>";
        }

        echo '<div>Input aman: ' . $input . '</div>';
    }
    ?>
</body>
</html>
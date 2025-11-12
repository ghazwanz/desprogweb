<?php
session_start();
if (isset($_SESSION['status']) && $_SESSION['status'] == 'login') {
    header("Location: dashboard.php");
}

$error_message = "";
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'email_exists') {
        $error_message = "Email sudah terdaftar. Silakan gunakan email lain.";
    } elseif ($_GET['error'] == 'registration_failed') {
        $error_message = "Registrasi gagal. Silakan coba lagi.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Click Up Register</title>
</head>

<body>
    <main class="fade">
        <div class="container">
            <div class="login-section">
                <div class="logo">
                    <a href="./">
                        <img src="img/logo-v3-clickup-light.svg" width="180" height="50" />
                    </a>
                </div>
                <h1>Create Account</h1>
                <?php if ($error_message): ?>
                    <div class="error-message" style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <form id="register-form" method="post" action="proses-register.php">

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="Email Address">
                        <span id="email-error" style="color: red;"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password">
                        <span id="password-error" style="color: red;"></span>
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password">
                        <span id="confirm-password-error" style="color: red;"></span>
                    </div>

                    <input type="submit" class="login-btn" value="Sign Up"></input>
                </form>

                <div class="signup-link">
                    Already have an account? <a href="login.php">Log in</a>
                </div>
            </div>

            <div class="right-section">
                <img src="./img/login-widget.jpg" alt="">
            </div>
        </div>
    </main>
    <script src="jquery-3.7.1.js"></script>
    <script>
        $(document).ready(() => {
            $('.fade').fadeIn('1000ms')
            $('.fade').animate({
                top: 0
            }, '300ms')

            $("#register-form").submit((e) => {
                const username = $("#username").val()
                const email = $("#email").val()
                const pass = $("#password").val()
                const confirmPass = $("#confirm-password").val()

                $("#username-error").text("");
                $("#email-error").text("");
                $("#password-error").text("");
                $("#confirm-password-error").text("");

                let valid = true;

                if (username === "") {
                    $("#username-error").text("Username harus diisi.");
                    valid = false;
                }

                if (email === "") {
                    $("#email-error").text("Email harus diisi.");
                    valid = false;
                }

                if (pass === "") {
                    $("#password-error").text("Password harus diisi.");
                    valid = false;
                }

                if (confirmPass === "") {
                    $("#confirm-password-error").text("Konfirmasi password harus diisi.");
                    valid = false;
                } else if (pass !== confirmPass) {
                    $("#confirm-password-error").text("Password tidak cocok.");
                    valid = false;
                }

                if (!valid) {
                    e.preventDefault();
                }
            })
        })
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Click Up Login</title>
</head>

<body>
    <main class="fade">
        <div class="container">
            <div class="login-section">
                <div class="logo">
                    <img src="img/logo-v3-clickup-light.svg" width="180" height="50" />
                </div>
                <h1>Welcome Back</h1>
                <form id="login-form" method="post" action="dashboard.php">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="Email Address">
                        <span id="email-error" style="color: red;"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password">
                        <span id="password-error" style="color: red;"></span>
                        <span id="not-valid" style="color: red;"></span>
                    </div>
                    
                    <div class="form-footer">
                        <label class="keep-logged">
                            <input type="checkbox" id="keep-logged">
                            <span>Keep me logged in</span>
                        </label>
                        <a href="#" class="forgot-password">Forgot your password?</a>
                    </div>

                    <input type="submit" class="login-btn" value="Log In"></input>
                </form>

                <div class="signup-link">
                    Don't have an account? <a href="#">Sign up</a>
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

            $("#login-form").submit((e) => {
                const email = $("#email").val()
                const pass = $("#password").val()

                $("#email-error").text("");
                $("#password-error").text("");
                $("#not-valid").text("");

                let valid = true;

                if (email === "") {
                    $("#email-error").text("Email harus diisi.");
                    valid = false;
                }

                if (pass === "") {
                    $("#password-error").text("Password harus diisi.");
                    valid = false;
                }

                if (pass !== "" && email !== "") {
                    if (email !== "atmint123@gmail.com" && pass !== "admin123#") {
                        $("#not-valid").text("Email atau Password anda salah!")
                        valid = false;
                    }
                }

                if (!valid) {
                    e.preventDefault();
                }


            })
        })
    </script>
</body>

</html>
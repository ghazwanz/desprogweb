<!DOCTYPE html>
<html>
<head>
<title>Form Validasi dengan AJAX</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h1>Form Validasi dengan AJAX</h1>

<form id="myForm"> 
    <label for="nama">Nama: </label>
    <input type="text" id="nama" name="nama" value=""> 
    <span id="nama-error" style="color: red;"></span><br><br>
    
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="">
    <span id="email-error" style="color: red;"></span><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" value="">
    <span id="password-error" style="color: red;"></span><br><br>
    
    <input type="submit" value="Submit">
</form>

<div id="ajax-result"></div>

<script>
$(document).ready(function() {
    $("#myForm").submit(function(event) {
        event.preventDefault();
        
        var nama = $("#nama").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var valid = true;

        $("#nama-error").text("");
        $("#email-error").text(""); 
        $("#ajax-result").html("");
        $("#password-error").text("");


        if (nama === "") {
            $("#nama-error").text("Nama harus diisi!");
            valid = false;
        } 

        if (email === "") {
            $("#email-error").text("Email harus diisi.");
            valid = false;
        }

        if (password === "") {
            $("#password-error").text("Password harus diisi.");
            valid = false;
        } else if (password.length < 8) {
            $("#password-error").text("Password minimal 8 karakter.");
            valid = false;
        }

        if (valid) {
            var formData = $("#myForm").serialize();
            $.ajax({
                url: "proses_validasi.php",
                type: "POST",
                data: formData,
                success: function (response) {
                    $("#ajax-result").html(response);
                },
            });
        }
    });
});
</script>
</body>
</html>
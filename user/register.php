<?php

require '../functions.php';

if (isset($_POST["register"])) {

    $username = htmlspecialchars($_POST["username"]);
    $password = mysqli_real_escape_string($conn,$_POST["password"]);
    $password2 = mysqli_real_escape_string($conn,$_POST["password2"]);

    // cek username
    $cek = mysqli_query($conn, "SELECT username FROM users WHERE username='$username'");
    if (mysqli_fetch_assoc($cek)) {
        echo "<script>alert('username sudah terdaftar!');</script>";
        return false;
    }

    // cek password
    if ($password !== $password2) {
        echo "<script>alert('password tidak sama!');</script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password', 'user')");
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
            alert('registrasi berhasil');
            document.location.href = '../user/login.php';
            </script>";
    } else {
        echo "registrasi gagal!";
    }

}
?>

	<link rel="stylesheet" href="login.css">

<body class="auth">

<div class="auth-box">

    <form method="post">

        <h2>Registrasi</h2>

        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password2" placeholder="Konfirmasi Password" required>

        <button type="submit" name="register">Daftar</button>

        <p class="auth-text">
            Sudah punya akun? 
            <a href="login.php">Login</a>
        </p>

    </form>

</div>
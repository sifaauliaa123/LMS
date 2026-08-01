<?php
session_start();
include 'config/koneksi.php';

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($query) > 0) {

        $user = mysqli_fetch_assoc($query);

        if (password_verify($password, $user['password'])) {

            $_SESSION['id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];

            header("Location: dashboard.php");
            exit;

        } else {
            echo "<script>alert('Password salah!');</script>";
        }

    } else {
        echo "<script>alert('Email tidak ditemukan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SmartLMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/auth.css">
    <link rel="manifest" href="/SmartLMS/manifest.json">
<meta name="theme-color" content="#6C4CF1">
</head>

<body class="login-page">

<div class="login-card">

    <h2>SmartLMS</h2>
    <p>Silakan login untuk melanjutkan</p>

    <form method="POST">

        <div class="mb-3">
            <input
                type="email"
                name="email"
                class="form-control"
                placeholder="Email"
                required>
        </div>

        <div class="mb-3">
            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="Password"
                required>
        </div>

        <button
            type="submit"
            name="login"
            class="btn btn-login w-100">
            Login
        </button>

    </form>

    <div class="text-center mt-3">
        Belum punya akun?
        <a href="register.php">Daftar</a>
    </div>

</div>

</body>
</html>
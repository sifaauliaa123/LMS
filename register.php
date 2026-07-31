<?php
include 'config/koneksi.php';

if(isset($_POST['register'])){

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = mysqli_query($conn,"INSERT INTO users(nama,email,password)
    VALUES('$nama','$email','$password')");

    if($sql){
        echo "<script>
        alert('Registrasi berhasil!');
        window.location='login.php';
        </script>";
    }else{
        echo "<script>alert('Registrasi gagal');</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/auth.css">

</head>

<body class="login-page">

<div class="login-card">

<h2>Daftar SmartLMS</h2>

<p>Buat akun baru</p>

<form method="POST">

<div class="mb-3">
<input
type="text"
name="nama"
class="form-control"
placeholder="Nama Lengkap"
required>
</div>

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
name="register"
class="btn btn-login w-100">
Daftar
</button>

</form>

<div class="text-center mt-3">
Sudah punya akun?
<a href="login.php">Login</a>
</div>

</div>

</body>

</html>
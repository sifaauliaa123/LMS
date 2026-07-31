<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

if(isset($_POST['simpan'])){

    $nama=mysqli_real_escape_string($conn,$_POST['nama']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $no_hp=mysqli_real_escape_string($conn,$_POST['no_hp']);

    mysqli_query($conn,"
    INSERT INTO mentors(nama,email,no_hp)
    VALUES('$nama','$email','$no_hp')
    ");

    header("Location: mentors.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>Tambah Mentor</title>

<link rel="stylesheet" href="assets/css/dashboard.css">

</head>

<body>

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="content">

<div class="form-card">

<h1>👨‍🏫 Tambah Mentor</h1>

<form method="POST">

<div class="form-group">

<label>Nama Mentor</label>

<input type="text" name="nama" required>

</div>

<div class="form-group">

<label>Email</label>

<input type="email" name="email" required>

</div>

<div class="form-group">

<label>No HP</label>

<input type="text" name="no_hp" required>

</div>

<div class="form-button">

<button class="btn-purple" name="simpan">

💾 Simpan Mentor

</button>

<a href="mentors.php" class="btn-cancel">

Batal

</a>

</div>

</form>

</div>

</div>

</body>

</html>
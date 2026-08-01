<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

if(isset($_POST['simpan'])){

    $nama = mysqli_real_escape_string($conn, $_POST['nama_course']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $mentor = mysqli_real_escape_string($conn, $_POST['mentor']);

    $insert = mysqli_query($conn,"
        INSERT INTO courses(nama_course, deskripsi, mentor)
        VALUES('$nama','$deskripsi','$mentor')
    ");

    if($insert){
        echo "<script>
            alert('Course berhasil ditambahkan!');
            window.location='courses.php';
        </script>";
    }else{
        echo "<script>alert('Gagal menambahkan course!');</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Course</title>

<link rel="stylesheet" href="assets/css/dashboard.css">

</head>

<body>

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="content">

<div class="form-card">

<h1>📚 Tambah Course</h1>

<p>Lengkapi informasi course di bawah ini.</p>

<form method="POST">

<div class="form-group">

<label>Nama Course</label>

<input
type="text"
name="nama_course"
placeholder="Contoh : HTML Dasar"
required>

</div>

<div class="form-group">

<label>Deskripsi</label>

<textarea
name="deskripsi"
rows="5"
placeholder="Masukkan deskripsi course..."
required></textarea>

</div>

<div class="form-group">

<label>Mentor</label>

<input
type="text"
name="mentor"
placeholder="Nama Mentor"
required>

</div>

<div class="form-button">

<button
type="submit"
name="simpan"
class="btn-purple">

💾 Simpan Course

</button>

<a href="courses.php" class="btn-cancel">

Batal

</a>

</div>

</form>

</div>

</div>

</body>

</html>
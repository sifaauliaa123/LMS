<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

// Ambil daftar course
$course = mysqli_query($conn, "SELECT * FROM courses ORDER BY nama_course ASC");

// Simpan data
if(isset($_POST['simpan'])){

    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $course_id = (int) $_POST['course_id'];

    $insert = mysqli_query($conn,"
        INSERT INTO students(nama,email,course_id)
        VALUES('$nama','$email','$course_id')
    ");

    if($insert){
        echo "<script>
            alert('Student berhasil ditambahkan!');
            window.location='students.php';
        </script>";
        exit;
    }else{
        echo "<script>alert('Gagal menambahkan student!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Student</title>

<link rel="stylesheet" href="assets/css/dashboard.css">

</head>

<body>

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="content">

<div class="form-card">

<h1>👨‍🎓 Tambah Student</h1>

<p>Masukkan data student di bawah ini.</p>

<form method="POST">

<div class="form-group">

<label>Nama Student</label>

<input
type="text"
name="nama"
placeholder="Masukkan nama student"
required>

</div>

<div class="form-group">

<label>Email</label>

<input
type="email"
name="email"
placeholder="contoh@email.com"
required>

</div>

<div class="form-group">

<label>Course</label>

<select name="course_id" required>

<option value="">-- Pilih Course --</option>

<?php while($c = mysqli_fetch_assoc($course)){ ?>

<option value="<?= $c['id']; ?>">
    <?= htmlspecialchars($c['nama_course']); ?>
</option>

<?php } ?>

</select>

</div>

<div class="form-button">

<button
type="submit"
name="simpan"
class="btn-purple">

💾 Simpan Student

</button>

<a href="students.php" class="btn-cancel">

Batal

</a>

</div>

</form>

</div>

</div>

</body>
</html>
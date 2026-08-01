<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

$id = (int)$_GET['id'];

$student = mysqli_query($conn,"
SELECT * FROM students
WHERE id='$id'
");

$data = mysqli_fetch_assoc($student);

$course = mysqli_query($conn,"
SELECT * FROM courses
ORDER BY nama_course ASC
");

if(isset($_POST['update'])){

    $nama = mysqli_real_escape_string($conn,$_POST['nama']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $course_id = (int)$_POST['course_id'];

    mysqli_query($conn,"
    UPDATE students SET
    nama='$nama',
    email='$email',
    course_id='$course_id'
    WHERE id='$id'
    ");

    echo "<script>
    alert('Student berhasil diperbarui!');
    window.location='students.php';
    </script>";

}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Edit Student</title>

<link rel="stylesheet" href="assets/css/dashboard.css">

</head>

<body>

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="content">

<div class="form-card">

<h1>✏ Edit Student</h1>

<p>Perbarui data student.</p>

<form method="POST">

<div class="form-group">

<label>Nama</label>

<input
type="text"
name="nama"
value="<?= htmlspecialchars($data['nama']) ?>"
required>

</div>

<div class="form-group">

<label>Email</label>

<input
type="email"
name="email"
value="<?= htmlspecialchars($data['email']) ?>"
required>

</div>

<div class="form-group">

<label>Course</label>

<select name="course_id">

<?php while($c=mysqli_fetch_assoc($course)){ ?>

<option
value="<?= $c['id']; ?>"
<?= ($c['id']==$data['course_id']) ? 'selected' : ''; ?>>

<?= htmlspecialchars($c['nama_course']); ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-button">

<button
type="submit"
name="update"
class="btn-purple">

💾 Update Student

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
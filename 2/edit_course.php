<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM courses WHERE id='$id'");
$course = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nama = $_POST['nama_course'];
    $deskripsi = $_POST['deskripsi'];
    $mentor = $_POST['mentor'];

    mysqli_query($conn,"
        UPDATE courses
        SET
            nama_course='$nama',
            deskripsi='$deskripsi',
            mentor='$mentor'
        WHERE id='$id'
    ");

    header("Location: courses.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Edit Course</title>

<link rel="stylesheet" href="assets/css/dashboard.css">

</head>

<body>

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="content">

<h1>Edit Course</h1>

<form method="POST">

<div class="mb-3">
<label>Nama Course</label>
<input
type="text"
name="nama_course"
class="form-control"
value="<?= htmlspecialchars($course['nama_course']) ?>"
required>
</div>

<div class="mb-3">
<label>Deskripsi</label>
<textarea
name="deskripsi"
class="form-control"><?= htmlspecialchars($course['deskripsi']) ?></textarea>
</div>

<div class="mb-3">
<label>Mentor</label>
<input
type="text"
name="mentor"
class="form-control"
value="<?= htmlspecialchars($course['mentor']) ?>"
required>
</div>

<br>

<button class="btn-purple" name="update">
Update Course
</button>

</form>

</div>

</body>
</html>
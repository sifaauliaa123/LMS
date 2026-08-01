<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

$id = (int)$_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM mentors WHERE id='$id'"));

if(isset($_POST['update'])){

    $nama = mysqli_real_escape_string($conn,$_POST['nama']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $no_hp = mysqli_real_escape_string($conn,$_POST['no_hp']);

    mysqli_query($conn,"
    UPDATE mentors SET
    nama='$nama',
    email='$email',
    no_hp='$no_hp'
    WHERE id='$id'
    ");

    header("Location: mentors.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Edit Mentor</title>

<link rel="stylesheet" href="assets/css/dashboard.css">

</head>

<body>

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="content">

<div class="form-card">

<h1>✏ Edit Mentor</h1>

<form method="POST">

<div class="form-group">

<label>Nama Mentor</label>

<input
type="text"
name="nama"
value="<?= htmlspecialchars($data['nama']); ?>"
required>

</div>

<div class="form-group">

<label>Email</label>

<input
type="email"
name="email"
value="<?= htmlspecialchars($data['email']); ?>"
required>

</div>

<div class="form-group">

<label>No HP</label>

<input
type="text"
name="no_hp"
value="<?= htmlspecialchars($data['no_hp']); ?>"
required>

</div>

<div class="form-button">

<button class="btn-purple" name="update">

💾 Update Mentor

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
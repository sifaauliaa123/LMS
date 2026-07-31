<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

$quiz_id = isset($_GET['quiz_id']) ? (int)$_GET['quiz_id'] : 0;

// Cek quiz
$quiz = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM quiz
WHERE id=$quiz_id
"));

if(!$quiz){
    header("Location: quiz.php");
    exit;
}

// Simpan soal
if(isset($_POST['simpan'])){

    $pertanyaan = mysqli_real_escape_string($conn,$_POST['pertanyaan']);
    $a = mysqli_real_escape_string($conn,$_POST['pilihan_a']);
    $b = mysqli_real_escape_string($conn,$_POST['pilihan_b']);
    $c = mysqli_real_escape_string($conn,$_POST['pilihan_c']);
    $d = mysqli_real_escape_string($conn,$_POST['pilihan_d']);
    $jawaban = $_POST['jawaban'];

    mysqli_query($conn,"
    INSERT INTO questions
    (
        quiz_id,
        pertanyaan,
        pilihan_a,
        pilihan_b,
        pilihan_c,
        pilihan_d,
        jawaban
    )
    VALUES
    (
        '$quiz_id',
        '$pertanyaan',
        '$a',
        '$b',
        '$c',
        '$d',
        '$jawaban'
    )
    ");

    header("Location: questions.php?quiz_id=".$quiz_id);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Soal</title>

<link rel="stylesheet" href="assets/css/dashboard.css">

</head>

<body>

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="content">

<div class="page-header">

<h1>➕ Tambah Soal</h1>

</div>

<div class="form-card">

<form method="POST">

<div class="form-group">

<label>Pertanyaan</label>

<textarea
name="pertanyaan"
rows="4"
required></textarea>

</div>

<div class="form-group">

<label>Pilihan A</label>

<input
type="text"
name="pilihan_a"
required>

</div>

<div class="form-group">

<label>Pilihan B</label>

<input
type="text"
name="pilihan_b"
required>

</div>

<div class="form-group">

<label>Pilihan C</label>

<input
type="text"
name="pilihan_c"
required>

</div>

<div class="form-group">

<label>Pilihan D</label>

<input
type="text"
name="pilihan_d"
required>

</div>

<div class="form-group">

<label>Jawaban Benar</label>

<select name="jawaban" required>

<option value="">Pilih Jawaban</option>

<option value="A">A</option>

<option value="B">B</option>

<option value="C">C</option>

<option value="D">D</option>

</select>

</div>

<button
type="submit"
name="simpan"
class="btn-primary">

💾 Simpan

</button>

<a
href="questions.php?quiz_id=<?= $quiz_id ?>"
class="btn-secondary">

← Kembali

</a>

</form>

</div>

</div>

<?php include 'includes/footer.php'; ?>

</body>

</html>
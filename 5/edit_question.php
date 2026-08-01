<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

$id = (int)$_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM questions
WHERE id=$id
"));

if(!$data){
    header("Location: quiz.php");
    exit;
}

if(isset($_POST['update'])){

    $pertanyaan = mysqli_real_escape_string($conn,$_POST['pertanyaan']);
    $a = mysqli_real_escape_string($conn,$_POST['pilihan_a']);
    $b = mysqli_real_escape_string($conn,$_POST['pilihan_b']);
    $c = mysqli_real_escape_string($conn,$_POST['pilihan_c']);
    $d = mysqli_real_escape_string($conn,$_POST['pilihan_d']);
    $jawaban = $_POST['jawaban'];

    mysqli_query($conn,"
    UPDATE questions SET

    pertanyaan='$pertanyaan',
    pilihan_a='$a',
    pilihan_b='$b',
    pilihan_c='$c',
    pilihan_d='$d',
    jawaban='$jawaban'

    WHERE id=$id
    ");

    header("Location: questions.php?quiz_id=".$data['quiz_id']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>Edit Soal</title>

<link rel="stylesheet" href="assets/css/dashboard.css">

</head>

<body>

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="content">

<div class="page-header">

<h1>✏ Edit Soal</h1>

</div>

<div class="form-card">

<form method="POST">

<div class="form-group">

<label>Pertanyaan</label>

<textarea
name="pertanyaan"
rows="4"
required><?= htmlspecialchars($data['pertanyaan']); ?></textarea>

</div>

<div class="form-group">

<label>Pilihan A</label>

<input
type="text"
name="pilihan_a"
value="<?= htmlspecialchars($data['pilihan_a']); ?>"
required>

</div>

<div class="form-group">

<label>Pilihan B</label>

<input
type="text"
name="pilihan_b"
value="<?= htmlspecialchars($data['pilihan_b']); ?>"
required>

</div>

<div class="form-group">

<label>Pilihan C</label>

<input
type="text"
name="pilihan_c"
value="<?= htmlspecialchars($data['pilihan_c']); ?>"
required>

</div>

<div class="form-group">

<label>Pilihan D</label>

<input
type="text"
name="pilihan_d"
value="<?= htmlspecialchars($data['pilihan_d']); ?>"
required>

</div>

<div class="form-group">

<label>Jawaban</label>

<select name="jawaban">

<option value="A" <?= $data['jawaban']=="A"?"selected":""; ?>>A</option>
<option value="B" <?= $data['jawaban']=="B"?"selected":""; ?>>B</option>
<option value="C" <?= $data['jawaban']=="C"?"selected":""; ?>>C</option>
<option value="D" <?= $data['jawaban']=="D"?"selected":""; ?>>D</option>

</select>

</div>

<button
type="submit"
name="update"
class="btn-primary">

💾 Update

</button>

<a
href="questions.php?quiz_id=<?= $data['quiz_id']; ?>"
class="btn-secondary">

← Kembali

</a>

</form>

</div>

</div>

<?php include 'includes/footer.php'; ?>

</body>

</html>
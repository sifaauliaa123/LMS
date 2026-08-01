<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

$quiz_id = isset($_GET['quiz_id']) ? (int)$_GET['quiz_id'] : 0;

// Ambil data quiz
$quiz = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM quiz
WHERE id = $quiz_id
"));

if(!$quiz){
    header("Location: quiz.php");
    exit;
}

// Ambil semua soal
$query = mysqli_query($conn,"
SELECT *
FROM questions
WHERE quiz_id = $quiz_id
ORDER BY id ASC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Questions</title>

<link rel="stylesheet" href="assets/css/dashboard.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="content">

<div class="page-header">

<h1>📄 Soal Quiz</h1>

<a href="tambah_question.php?quiz_id=<?= $quiz_id ?>" class="btn-primary">

+ Tambah Soal

</a>

</div>

<h3 style="margin-bottom:20px;">

Quiz :
<b><?= htmlspecialchars($quiz['judul']); ?></b>

</h3>

<div class="table-card">

<table class="table">

<thead>

<tr>

<th>No</th>

<th>Pertanyaan</th>

<th>Jawaban</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

if(mysqli_num_rows($query)>0){

$no=1;

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= htmlspecialchars($row['pertanyaan']); ?></td>

<td><?= $row['jawaban']; ?></td>

<td>

<a href="edit_question.php?id=<?= $row['id']; ?>" class="btn-edit">

Edit

</a>

<a href="#"
class="btn-delete"
onclick="hapusQuestion(<?= $row['id']; ?>, <?= $quiz_id; ?>)">

🗑 Hapus

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="4" style="text-align:center;padding:30px;">

📭 Belum ada soal.

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

<?php include 'includes/footer.php'; ?>



</body>

<script>

<script>

function hapusQuestion(id, quiz_id){

    Swal.fire({

        title: 'Hapus Soal?',

        text: 'Data soal yang dihapus tidak dapat dikembalikan.',

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#7C3AED',

        cancelButtonColor: '#6c757d',

        confirmButtonText: 'Ya, Hapus',

        cancelButtonText: 'Batal'

    }).then((result)=>{

        if(result.isConfirmed){

            window.location = 'hapus_question.php?id=' + id + '&quiz_id=' + quiz_id;

        }

    });

}

</script>

</script>

</html>
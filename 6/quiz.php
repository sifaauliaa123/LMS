<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

$query = mysqli_query($conn, "
SELECT quiz.*, courses.nama_course
FROM quiz
LEFT JOIN courses
ON quiz.course_id = courses.id
ORDER BY quiz.id DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Quiz</title>

<link rel="stylesheet" href="assets/css/dashboard.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="content">

    <div class="page-header">

        <h1>📝 Quiz</h1>

        <a href="tambah_quiz.php" class="btn-primary">
            + Tambah Quiz
        </a>

    </div>

    <div class="table-card">

        <input
            type="text"
            id="searchInput"
            class="search-box"
            placeholder="🔍 Cari Quiz...">

        <table class="table" id="quizTable">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Judul Quiz</th>
                    <th>Course</th>
                    <th>Dibuat</th>
                    <th style="width:220px;">Aksi</th>

                </tr>

            </thead>

            <tbody>

            <?php if(mysqli_num_rows($query) > 0){ ?>

                <?php $no = 1; ?>

                <?php while($row = mysqli_fetch_assoc($query)){ ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td><?= htmlspecialchars($row['judul']); ?></td>

                    <td><?= htmlspecialchars($row['nama_course']); ?></td>

                    <td><?= date('d M Y', strtotime($row['created_at'])); ?></td>

                    <td>

<div class="action-buttons">

<a href="questions.php?quiz_id=<?= $row['id']; ?>" class="btn-action btn-soal">
📄 Soal
</a>

<a href="edit_quiz.php?id=<?= $row['id']; ?>" class="btn-action btn-edit">
✏ Edit
</a>

<a href="#"
class="btn-action btn-delete"
onclick="hapusQuiz(<?= $row['id']; ?>)">
🗑 Hapus
</a>

</div>

</td>

                </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>

                    <td colspan="5" style="text-align:center;padding:35px;color:#777;">

                        📭 Belum ada data quiz.

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<script>

const searchInput = document.getElementById("searchInput");

searchInput.addEventListener("keyup", function () {

    let filter = this.value.toLowerCase();

    let rows = document.querySelectorAll("#quizTable tbody tr");

    rows.forEach(function(row){

        row.style.display = row.innerText.toLowerCase().includes(filter)
            ? ""
            : "none";

    });

});

</script>

<?php include 'includes/footer.php'; ?>

<script src="assets/js/app.js"></script>

</body>

<script>

function hapusQuiz(id){

Swal.fire({

title:'Hapus Quiz?',

text:'Data yang dihapus tidak dapat dikembalikan.',

icon:'warning',

showCancelButton:true,

confirmButtonColor:'#7C3AED',

cancelButtonColor:'#6c757d',

confirmButtonText:'Ya, Hapus',

cancelButtonText:'Batal'

}).then((result)=>{

if(result.isConfirmed){

window.location='hapus_quiz.php?id='+id;

}

});

}

</script>

</html>
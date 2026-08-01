<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

$result = mysqli_query($conn, "
SELECT students.*, courses.nama_course
FROM students
LEFT JOIN courses
ON students.course_id = courses.id
ORDER BY students.id DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Students - SmartLMS</title>

<link rel="stylesheet" href="assets/css/dashboard.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="content">

<div class="page-header">

<div>

<h1>👨‍🎓 Students</h1>

<div class="search-box">
<input
type="text"
id="searchStudent"
placeholder="🔍 Cari student...">
</div>

</div>

<a href="tambah_student.php" class="btn-purple">
+ Tambah Student
</a>

</div>

<div class="course-grid">

<?php if(mysqli_num_rows($result) > 0){ ?>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="course-card student-item">

<h3>👨‍🎓 <?= htmlspecialchars($row['nama']); ?></h3>

<p>📧 <?= htmlspecialchars($row['email']); ?></p>

<small>
📚 Course :
<b><?= htmlspecialchars($row['nama_course']); ?></b>
</small>

<div class="course-action">

<a href="edit_student.php?id=<?= $row['id']; ?>">
✏ Edit
</a>

<a href="#"
class="btn-delete"
onclick="hapusStudent(<?= $row['id']; ?>)">

🗑 Hapus

</a>

</div>

</div>

<?php } ?>

<?php } else { ?>

<div class="empty-course">

<h3>👨‍🎓 Belum ada student</h3>

<p>
Silakan klik
<b>+ Tambah Student</b>
untuk menambahkan data.
</p>

</div>

<?php } ?>

</div>

</div>

<script>

const search = document.getElementById("searchStudent");

search.addEventListener("keyup", function(){

let keyword = this.value.toLowerCase();

document.querySelectorAll(".student-item").forEach(function(card){

let isi = card.innerText.toLowerCase();

card.style.display = isi.includes(keyword)
? "block"
: "none";

});

});

</script>

<script>

function hapusStudent(id){

    Swal.fire({

        title:'Hapus Student?',

        text:'Data yang dihapus tidak dapat dikembalikan.',

        icon:'warning',

        showCancelButton:true,

        confirmButtonColor:'#7C3AED',

        cancelButtonColor:'#6c757d',

        confirmButtonText:'Ya, Hapus',

        cancelButtonText:'Batal'

    }).then((result)=>{

        if(result.isConfirmed){

            window.location='hapus_student.php?id='+id;

        }

    });

}

</script>

<script src="assets/js/app.js"></script>

</body>
</html>
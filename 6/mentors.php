<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

$result = mysqli_query($conn, "SELECT * FROM mentors ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Mentors - SmartLMS</title>

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

<h1>👨‍🏫 Mentors</h1>

<div class="search-box">
<input type="text" id="searchMentor" placeholder="🔍 Cari mentor...">
</div>

</div>

<a href="tambah_mentor.php" class="btn-purple">
+ Tambah Mentor
</a>

</div>

<div class="course-grid">

<?php if(mysqli_num_rows($result)>0){ ?>

<?php while($mentor=mysqli_fetch_assoc($result)){ ?>

<div class="course-card mentor-item">

<h3>👨‍🏫 <?= htmlspecialchars($mentor['nama']); ?></h3>

<p>📧 <?= htmlspecialchars($mentor['email']); ?></p>

<p>📱 <?= htmlspecialchars($mentor['no_hp']); ?></p>

<div class="course-action">

<a href="edit_mentor.php?id=<?= $mentor['id']; ?>">✏ Edit</a>

<a href="#"
class="btn-delete"
onclick="hapusMentor(<?= $mentor['id']; ?>)">

🗑 Hapus

</a>

</div>

</div>

<?php } ?>

<?php }else{ ?>

<div class="empty-course">

<h3>👨‍🏫 Belum ada Mentor</h3>

<p>Silakan klik <b>+ Tambah Mentor</b>.</p>

</div>

<?php } ?>

</div>

</div>

<script>

const mentorSearch=document.getElementById("searchMentor");

mentorSearch.addEventListener("keyup",function(){

let keyword=this.value.toLowerCase();

document.querySelectorAll(".mentor-item").forEach(function(card){

let isi=card.innerText.toLowerCase();

card.style.display=isi.includes(keyword)
? "block"
: "none";

});

});

</script>

<script>

<script>

function hapusMentor(id){

    Swal.fire({

        title: 'Hapus Mentor?',

        text: 'Data yang dihapus tidak dapat dikembalikan.',

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#7C3AED',

        cancelButtonColor: '#6c757d',

        confirmButtonText: 'Ya, Hapus',

        cancelButtonText: 'Batal'

    }).then((result)=>{

        if(result.isConfirmed){

            window.location = 'hapus_mentor.php?id=' + id;

        }

    });

}

</script>

</script>

<script src="assets/js/app.js"></script>
</body>

</html>
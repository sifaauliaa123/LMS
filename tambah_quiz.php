<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

// Simpan Data
if (isset($_POST['simpan'])) {

    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $course_id = (int) $_POST['course_id'];

    mysqli_query($conn, "
        INSERT INTO quiz (judul, course_id)
        VALUES ('$judul', '$course_id')
    ");

    header("Location: quiz.php");
    exit;
}

// Ambil daftar course
$course = mysqli_query($conn, "
SELECT * FROM courses
ORDER BY nama_course ASC
");

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Quiz</title>

<link rel="stylesheet" href="assets/css/dashboard.css">

</head>

<body>

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="content">

    <div class="page-header">

        <h1>📝 Tambah Quiz</h1>

    </div>

    <div class="form-card">

        <form method="POST">

            <div class="form-group">

                <label>Judul Quiz</label>

                <input
                    type="text"
                    name="judul"
                    required
                    placeholder="Masukkan judul quiz">

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

            <button type="submit" name="simpan" class="btn-primary">

                💾 Simpan

            </button>

            <a href="quiz.php" class="btn-secondary">

                ← Kembali

            </a>

        </form>

    </div>

</div>

<?php include 'includes/footer.php'; ?>

</body>

</html>
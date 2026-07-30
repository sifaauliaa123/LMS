<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

$id = (int)$_GET['id'];

// Ambil data quiz
$data = mysqli_fetch_assoc(mysqli_query($conn, "
SELECT * FROM quiz
WHERE id = $id
"));

if (!$data) {
    header("Location: quiz.php");
    exit;
}

// Update data
if(isset($_POST['update'])){

    $judul = mysqli_real_escape_string($conn,$_POST['judul']);
    $course_id = (int)$_POST['course_id'];

    mysqli_query($conn,"
    UPDATE quiz
    SET
        judul='$judul',
        course_id='$course_id'
    WHERE id=$id
    ");

    header("Location: quiz.php");
    exit;
}

// Ambil semua course
$course = mysqli_query($conn,"
SELECT *
FROM courses
ORDER BY nama_course ASC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Quiz</title>

<link rel="stylesheet" href="assets/css/dashboard.css">

</head>

<body>

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="content">

    <div class="page-header">

        <h1>✏️ Edit Quiz</h1>

    </div>

    <div class="form-card">

        <form method="POST">

            <div class="form-group">

                <label>Judul Quiz</label>

                <input
                    type="text"
                    name="judul"
                    value="<?= htmlspecialchars($data['judul']); ?>"
                    required>

            </div>

            <div class="form-group">

                <label>Course</label>

                <select name="course_id" required>

                    <?php while($c=mysqli_fetch_assoc($course)){ ?>

                    <option
                        value="<?= $c['id']; ?>"
                        <?= ($c['id']==$data['course_id']) ? 'selected' : ''; ?>>

                        <?= htmlspecialchars($c['nama_course']); ?>

                    </option>

                    <?php } ?>

                </select>

            </div>

            <button
                type="submit"
                name="update"
                class="btn-primary">

                💾 Update

            </button>

            <a
                href="quiz.php"
                class="btn-secondary">

                ← Kembali

            </a>

        </form>

    </div>

</div>

<?php include 'includes/footer.php'; ?>

</body>

</html>
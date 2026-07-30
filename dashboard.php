<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

$totalCourse = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM courses"));
$totalStudent = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM students"));
$totalMentor = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM mentors"));
$totalQuiz = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM quiz"));
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard - SmartLMS</title>

<link rel="stylesheet" href="assets/css/dashboard.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="manifest" href="/SmartLMS/manifest.json">
<meta name="theme-color" content="#6C4CF1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>


<body>
    

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="content">

    <!-- Welcome -->
    <div class="welcome-banner">

        <div>

            <h1>👋 Welcome Back, <?= htmlspecialchars($_SESSION['nama']); ?>!</h1>

            <p>Kelola course, student, mentor, dan quiz dengan mudah.</p>

        </div>

        <div class="welcome-icon">
            🎓
        </div>

    </div>

    <!-- Statistik -->
    <div class="cards">

        <div class="card-box">
            <h4>📚 Courses</h4>
            <h2><?= $totalCourse['total']; ?></h2>
            <p>Total Course</p>
        </div>

        <div class="card-box">
            <h4>👨‍🎓 Students</h4>
            <h2><?= $totalStudent['total']; ?></h2>
            <p>Total Student</p>
        </div>

        <div class="card-box">
            <h4>👨‍🏫 Mentors</h4>
            <h2><?= $totalMentor['total']; ?></h2>
            <p>Total Mentor</p>
        </div>

        <div class="card-box">
            <h4>📝 Quiz</h4>
            <h2><?= $totalQuiz['total']; ?></h2>
            <p>Total Quiz</p>
        </div>

    </div>

    <!-- Recent Data -->
    <div class="dashboard-row">

        <div class="panel">

            <h2>📚 Recent Courses</h2>

            <?php
            $recentCourse = mysqli_query($conn,"
            SELECT * FROM courses
            ORDER BY id DESC
            LIMIT 5");
            ?>

            <?php while($c = mysqli_fetch_assoc($recentCourse)){ ?>

                <div class="list-item">
                    📚 <?= htmlspecialchars($c['nama_course']); ?>
                </div>

            <?php } ?>

        </div>

        <div class="panel">

            <h2>👨‍🎓 Recent Students</h2>

            <?php
            $recentStudent = mysqli_query($conn,"
            SELECT * FROM students
            ORDER BY id DESC
            LIMIT 5");
            ?>

            <?php while($s = mysqli_fetch_assoc($recentStudent)){ ?>

                <div class="list-item">
                    👨 <?= htmlspecialchars($s['nama']); ?>
                </div>

            <?php } ?>

        </div>

    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">

        <a href="tambah_course.php" class="action-card">
            ➕<br><br>
            Course
        </a>

        <a href="tambah_student.php" class="action-card">
            👨‍🎓<br><br>
            Student
        </a>

        <a href="tambah_mentor.php" class="action-card">
            👨‍🏫<br><br>
            Mentor
        </a>

        <a href="tambah_quiz.php" class="action-card">
            📝<br><br>
            Quiz
        </a>

    </div>

    <!-- Chart -->
    <div class="chart-card">

        <h2>📊 Statistik SmartLMS</h2>

        <canvas id="myChart"></canvas>

    </div>

</div>

<?php include 'includes/footer.php'; ?>

<script>

document.addEventListener("DOMContentLoaded", function(){

    const ctx = document.getElementById('myChart');

    if(ctx){

        new Chart(ctx,{

            type:'bar',

            data:{

                labels:[
                    'Courses',
                    'Students',
                    'Mentors',
                    'Quiz'
                ],

                datasets:[{

                    label:'Jumlah Data',

                    data:[
                        <?= $totalCourse['total']; ?>,
                        <?= $totalStudent['total']; ?>,
                        <?= $totalMentor['total']; ?>,
                        <?= $totalQuiz['total']; ?>
                    ],

                    backgroundColor:[
                        '#7C3AED',
                        '#2563EB',
                        '#10B981',
                        '#F59E0B'
                    ],

                    borderRadius:8

                }]

            },

            options:{

                responsive:true,

                maintainAspectRatio:false,

                plugins:{
                    legend:{
                        display:false
                    }
                }

            }

        });

    }

});

</script>
<script>
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
        navigator.serviceWorker.register('/SmartLMS/service-worker.js')
            .then(function(registration) {
                console.log('Service Worker berhasil didaftarkan:', registration.scope);
            })
            .catch(function(error) {
                console.log('Service Worker gagal:', error);
            });
    });
}
</script>


<script src="assets/js/app.js"></script>
</body>

</html>
<div class="sidebar">

    <div class="logo">
        <h2>🎓 SmartLMS</h2>
        <p>Learning Management System</p>
    </div>

    <<a href="dashboard.php">
    <i class="bi bi-speedometer2"></i>
    <span>Dashboard</span>
</a>

<a href="courses.php">
    <i class="bi bi-book"></i>
    <span>Courses</span>
</a>

<a href="students.php">
    <i class="bi bi-people"></i>
    <span>Students</span>
</a>

<a href="mentors.php">
    <i class="bi bi-person-workspace"></i>
    <span>Mentors</span>
</a>

<a href="quiz.php">
    <i class="bi bi-journal-text"></i>
    <span>Quiz</span>
</a>

<a href="#">
    <i class="bi bi-gear"></i>
    <span>Settings</span>
</a>

<a href="logout.php" class="logout">
    <i class="bi bi-box-arrow-right"></i>
    <span>Logout</span>
</a>

    <hr>

    <div class="sidebar-info">

        <small>Total Course</small>
        <h3><?= isset($totalCourse['total']) ? $totalCourse['total'] : 0; ?></h3>

        <small>Total Student</small>
        <h3><?= isset($totalStudent['total']) ? $totalStudent['total'] : 0; ?></h3>

    </div>

    <a href="logout.php" class="logout">
        🚪 <span>Logout</span>
    </a>

</div>
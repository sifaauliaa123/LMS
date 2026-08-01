<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM courses WHERE id='$id'");

header("Location: courses.php");
exit;
<?php

session_start();

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

$id = (int)$_GET['id'];

mysqli_query($conn,"DELETE FROM students WHERE id='$id'");

header("Location: students.php");
exit;
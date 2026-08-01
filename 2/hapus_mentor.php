<?php

session_start();

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

$id=(int)$_GET['id'];

mysqli_query($conn,
"DELETE FROM mentors WHERE id='$id'");

header("Location: mentors.php");
exit;
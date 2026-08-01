<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

include 'config/koneksi.php';

if(isset($_GET['id'])){

    $id = (int)$_GET['id'];

    mysqli_query($conn,"
    DELETE FROM quiz
    WHERE id=$id
    ");

}

header("Location: quiz.php");
exit;
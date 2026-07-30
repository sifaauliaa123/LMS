<?php
include 'config/koneksi.php';

$id = (int)$_GET['id'];
$quiz_id = (int)$_GET['quiz_id'];

mysqli_query($conn, "DELETE FROM questions WHERE id = $id");

header("Location: questions.php?quiz_id=$quiz_id");
exit;
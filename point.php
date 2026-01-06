<?php
session_start();

$db = mysqli_connect('localhost', 'root', '', 'skt');
if (!$db) die("DB 연결 실패");

$id = $_SESSION['id'] ?? null;
if (!$id) {
    exit();   
}

if (isset($_POST['mode']) && $_POST['mode'] === 'egg') {
    mysqli_query($db, "update healing set point = point + 100 where id = '$id'");
    exit();
}

if (isset($_POST['finish'])) {
    mysqli_query($db, "update healing set point = point + 500 where id = '$id'");
    exit();
}

mysqli_close($db);
?>
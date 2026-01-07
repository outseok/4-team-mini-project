<?php
session_start();

$db = mysqli_connect('localhost', 'root', '', 'user');
if (!$db) die("DB 연결 실패");

$id = $_SESSION['uid'] ?? null;
if (!$id) {
    // 로그인 안 된 상태면 로그인으로
    header("Location: index.php?p=login");
    exit;
}

mysqli_set_charset($db, 'utf8');

if (isset($_POST['mode']) && $_POST['mode'] === 'egg') {
    mysqli_query($db, "UPDATE user_info SET point = point + 100 WHERE uid = '$id'");
    mysqli_close($db);
    echo "<script>alert('100포인트 지급!'); location.href='index.php?p=help';</script>";
    exit;
}

if (isset($_POST['finish'])) {
    mysqli_query($db, "UPDATE user_info SET point = point + 500 WHERE uid = '$id'");
    mysqli_close($db);
    echo "<script>alert('500포인트 지급!'); location.href='index.php?p=main';</script>";
    exit;
}

mysqli_close($db);
header("Location: index.php?p=main");
exit;
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <title>다이어리 리스트</title>
</head>

<?php
include "dbconn.php";
session_start();
if (!isset($_SESSION['uid'])) {
    echo "<script>alert('로그인 후 이용해주시기 바랍니다.'); location.href='login.php';</script>";
    exit;
}
$uid = $_SESSION["uid"];
$sql = "SELECT * FROM diary WHERE uid = '$uid' ORDER BY reg_date DESC";

$host = "localhost";
$user = "root";
$pass = "";
$dbName = "user";

$dbconn = mysqli_connect($host, $user, $pass, $dbName);

if (!$dbconn) {
    die("DB 연결 실패: " . mysqli_connect_error());
}
mysqli_set_charset($dbconn, "utf8");
?>
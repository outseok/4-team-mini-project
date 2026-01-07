<<<<<<< HEAD
<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbName = "team01";

$dbconn = mysqli_connect($host, $user, $pass, $dbName);
if (!$dbconn) {
  die("DB 연결 실패: " . mysqli_connect_error());
}
=======
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <title>다이어리 인풋</title>
</head>

<?php

$host = "localhost";
$user = "root";      
$pass = "";         
$dbName = "team01"; 

// DB 연결
$dbconn = mysqli_connect($host, $user, $pass, "team01");

// 연결 확인
if (!$dbconn) {
    die("DB 연결 실패: " . mysqli_connect_error());
}

// 한글 깨짐 방지
>>>>>>> 6fe0b66811033990267d26c91cada475b405f3c3
mysqli_set_charset($dbconn, "utf8");
?>
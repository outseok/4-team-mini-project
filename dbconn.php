<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbName = "team01";

$dbconn = mysqli_connect($host, $user, $pass, $dbName);
if (!$dbconn) {
  die("DB 연결 실패: " . mysqli_connect_error());
}
mysqli_set_charset($dbconn, "utf8");
?>
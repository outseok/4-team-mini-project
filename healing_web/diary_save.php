<?php
session_start();
include "dbconn.php";

$uid = $_SESSION['uid'] ?? null;
if (!$uid) {
  echo "<script>alert('로그인 후 이용해주시기 바랍니다.'); location.href='login.html';</script>";
  exit;
}

$title   = trim($_POST['title'] ?? '');
$emotion = trim($_POST['emotion'] ?? '');
$content = trim($_POST['content'] ?? '');
$event_date = $_POST['event_date'] ?? null;

if ($title === '' || $emotion === '' || $content === '') {
  echo "<script>alert('제목/감정/내용은 필수입니다.'); history.back();</script>";
  exit;
}

$stmt = mysqli_prepare($dbconn, "INSERT INTO diary (uid, title, emotion, content, event_date, reg_date)
                                 VALUES (?, ?, ?, ?, ?, NOW())");
mysqli_stmt_bind_param($stmt, "sssss", $uid, $title, $emotion, $content, $event_date);
$ok = mysqli_stmt_execute($stmt);

if ($ok) {
  echo "<script>alert('오늘의 기록이 저장되었습니다!'); location.href='content.php';</script>";
} else {
  echo "<script>alert('저장에 실패했습니다.'); history.back();</script>";
}
?>

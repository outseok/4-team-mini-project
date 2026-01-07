<?php
session_start();
include "dbconn.php";

$uid = $_SESSION['uid'] ?? "guest";

$title = $_POST['title'] ?? '';
$emotion = $_POST['emotion'] ?? '';
$content = $_POST['content'] ?? '';
$event_date = $_POST['event_date'] ?? '';

$sql = "INSERT INTO diary (uid, title, emotion, content, event_date, reg_date)
        VALUES ('$uid', '$title', '$emotion', '$content', '$event_date', NOW())";

if (mysqli_query($dbconn, $sql)) {
  echo "<script>
          alert('오늘의 기록이 저장되었습니다!');
          location.href='index.php?p=content';
        </script>";
} else {
  echo "저장 실패: " . mysqli_error($dbconn);
}
mysqli_close($dbconn);
?>
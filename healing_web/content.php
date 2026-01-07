<?php
session_start();
include "dbconn.php";

$uid = $_SESSION['uid'] ?? null;
if (!$uid) {
  header("Location: login.html");
  exit;
}

$stmt = mysqli_prepare($dbconn, "SELECT title, emotion, content, event_date, reg_date FROM diary WHERE uid = ? ORDER BY reg_date DESC");
mysqli_stmt_bind_param($stmt, "s", $uid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <title>나의 감정 기록 목록</title>
  <style>
    body{font-family:'Malgun Gothic',sans-serif; background:#f9f9f9; margin:0; padding:30px;}
    .top{max-width:900px; margin:0 auto 14px; display:flex; justify-content:space-between; align-items:center;}
    .wrap{max-width:900px; margin:0 auto;}
    .card{background:#fff; border-radius:14px; padding:18px; margin:12px 0; box-shadow:0 6px 18px rgba(0,0,0,.06);}
    .title{font-size:18px; font-weight:800; margin:0 0 6px;}
    .meta{color:#666; font-size:13px; margin-bottom:10px;}
    .emotion{color:#ff4fa2; font-weight:800;}
    .content{white-space:pre-wrap; line-height:1.6; color:#333;}
    a.btn{display:inline-block; padding:10px 14px; border-radius:12px; background:#3aa6ff; color:#fff; text-decoration:none;}
    a.btn.gray{background:#6b7a88;}
  </style>
</head>
<body>
  <div class="top">
    <h2 style="margin:0;">내 기록</h2>
    <div style="display:flex; gap:10px;">
      <a class="btn gray" href="diary.html">새 기록</a>
      <a class="btn" href="main.php">메인</a>
    </div>
  </div>

  <div class="wrap">
    <?php if (mysqli_num_rows($result) === 0): ?>
      <div class="card">아직 저장된 기록이 없어요. 오늘의 감정을 기록해보세요 🙂</div>
    <?php else: ?>
      <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="card">
          <div class="title"><?= htmlspecialchars($row['title']) ?></div>
          <div class="meta">
            감정: <span class="emotion"><?= htmlspecialchars($row['emotion']) ?></span> ·
            날짜: <?= htmlspecialchars($row['event_date'] ?: '-') ?> ·
            작성: <?= htmlspecialchars($row['reg_date']) ?>
          </div>
          <div class="content"><?= htmlspecialchars($row['content']) ?></div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</body>
</html>

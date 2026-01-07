<?php
session_start();
include "dbconn.php";

$uid = $_SESSION['uid'] ?? ($_GET['uid'] ?? '');
$uid = trim($uid);

if ($uid === '') {
  header("Location: login.html");
  exit;
}

$stmt = mysqli_prepare($dbconn, "SELECT uname, uid, uemail, point, ip, uimage FROM user_info WHERE uid = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $uid);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($res);

if (!$user) {
  echo "<script>alert('사용자 정보를 찾을 수 없습니다.'); location.href='login.html';</script>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8" />
  <title>마이페이지</title>
  <style>
    body{font-family: 'Malgun Gothic', sans-serif; margin:0; background:#f5fbff;}
    .wrap{max-width:720px; margin:40px auto; background:#fff; border-radius:16px; padding:24px; box-shadow:0 8px 24px rgba(0,0,0,.08);}
    .top{display:flex; gap:20px; align-items:center;}
    .avatar{width:120px; height:120px; border-radius:50%; object-fit:cover; border:4px solid #e6f3ff;}
    .badge{display:inline-block; padding:6px 10px; border-radius:999px; background:#e6f3ff; font-size:14px;}
    .grid{margin-top:20px; display:grid; grid-template-columns: 140px 1fr; gap:10px 16px;}
    .k{color:#666;}
    .v{font-weight:600;}
    .actions{margin-top:24px; display:flex; gap:10px; flex-wrap:wrap;}
    .btn{display:inline-block; padding:10px 14px; border-radius:12px; background:#3aa6ff; color:#fff; text-decoration:none;}
    .btn.gray{background:#6b7a88;}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="top">
      <img class="avatar" src="<?= htmlspecialchars($user['uimage'] ?: 'image/profile.png') ?>" alt="profile" />
      <div>
        <h2 style="margin:0 0 6px;"><?= htmlspecialchars($user['uname']) ?> 님</h2>
        <div class="badge">포인트: <?= (int)$user['point'] ?> P</div>
      </div>
    </div>

    <div class="grid">
      <div class="k">아이디</div><div class="v"><?= htmlspecialchars($user['uid']) ?></div>
      <div class="k">이메일</div><div class="v"><?= htmlspecialchars($user['uemail']) ?></div>
      <div class="k">가입 IP</div><div class="v"><?= htmlspecialchars($user['ip']) ?></div>
    </div>

    <div class="actions">
      <a class="btn" href="main.php">메인으로</a>
      <a class="btn gray" href="content.php">내 기록 보기</a>
      <a class="btn gray" href="store.html">상점</a>
      <a class="btn gray" href="game.html">게임</a>
      <a class="btn gray" href="logout.php">로그아웃</a>
    </div>
  </div>
</body>
</html>

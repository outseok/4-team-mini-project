<?php
session_start();
include "dbconn.php";

$uid = $_SESSION['uid'] ?? null;
if (!$uid) {
  header("Location: login.html");
  exit;
}

// 포인트
$stmt = mysqli_prepare($dbconn, "SELECT uname, point FROM user_info WHERE uid = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $uid);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($res);
$point = (int)($user['point'] ?? 0);
$uname = $user['uname'] ?? $uid;

// 장착 아이템(없으면 기본)
$defaults = [
  'tree'  => ['name'=>'tree',  'image'=>'image/smalltree.png'],
  'house' => ['name'=>'house', 'image'=>'image/house.png'],
  'pet'   => ['name'=>'pet',   'image'=>'image/cat.png'],
];

$stmt = mysqli_prepare($dbconn, "SELECT type, name, image FROM myitem WHERE uid = ?");
mysqli_stmt_bind_param($stmt, "s", $uid);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
while ($row = mysqli_fetch_assoc($res)) {
  $t = $row['type'];
  if (isset($defaults[$t])) {
    $defaults[$t] = ['name'=>$row['name'], 'image'=>$row['image']];
  }
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="utf-8" />
  <title>Healing - Main</title>
  <style>
    body{margin:0; font-family:'Malgun Gothic',sans-serif; background:#cfefff;}
    .stage{
      position:relative;
      width: 1200px;
      max-width: 100%;
      height: 650px;
      margin: 0 auto;
      background-image: url('image/back.png');
      background-size: cover;
      background-position:center;
      overflow:hidden;
      border-radius: 18px;
      box-shadow: 0 10px 30px rgba(0,0,0,.12);
    }
    .hud{
      position:absolute; top:14px; left:14px;
      background: rgba(255,255,255,.75);
      padding:10px 14px;
      border-radius: 14px;
      display:flex; gap:12px; align-items:center;
      backdrop-filter: blur(6px);
    }
    .hud .p{font-weight:700;}
    .nav{
      position:absolute; top:14px; right:14px;
      display:flex; gap:10px;
    }
    .nav a{
      display:inline-flex; align-items:center; justify-content:center;
      width:64px; height:64px;
      background: rgba(255,255,255,.75);
      border-radius: 16px;
      text-decoration:none;
      backdrop-filter: blur(6px);
    }
    .nav img{width:44px; height:44px;}
    .obj{position:absolute; bottom:40px;}
    .tree{left:120px; width:260px;}
    .house{left:430px; width:360px;}
    .pet{left:860px; width:160px;}
    .footer{
      max-width:1200px; margin: 14px auto 0; display:flex; justify-content:space-between; align-items:center;
      padding:0 6px;
    }
    .footer a{color:#0b4a7a; text-decoration:none; font-weight:700;}
  </style>
</head>
<body>
  <div class="stage">
    <div class="hud">
      <div>안녕하세요, <b><?= htmlspecialchars($uname) ?></b>!</div>
      <div class="p">포인트: <?= $point ?> P</div>
    </div>

    <div class="nav">
      <a href="diary.html" title="일기"><img src="image/diary.png" alt="diary"></a>
      <a href="game.html" title="게임"><img src="image/game.png" alt="game"></a>
      <a href="store.html" title="상점"><img src="image/store.png" alt="store"></a>
      <a href="mypage.php" title="마이페이지"><img src="image/profile.png" alt="mypage"></a>
    </div>

    <img class="obj tree" src="<?= htmlspecialchars($defaults['tree']['image']) ?>" alt="tree">
    <img class="obj house" src="<?= htmlspecialchars($defaults['house']['image']) ?>" alt="house">
    <img class="obj pet" src="<?= htmlspecialchars($defaults['pet']['image']) ?>" alt="pet">
  </div>

  <div class="footer">
    <a href="content.php">📒 내 기록 보기</a>
    <a href="logout.php">로그아웃</a>
  </div>
</body>
</html>

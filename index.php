<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$p = $_GET['p'] ?? 'home';

function active($name, $p) {
  return $name === $p ? 'font-weight:700;' : '';
}

// 로그인 필요 페이지들
$needLogin = ['game','diary','content','help','main'];

// 로그인 안 했는데 보호 페이지 접근하면 로그인으로 보냄
if (!isset($_SESSION['uid']) && in_array($p, $needLogin, true)) {
  header("Location: index.php?p=login");
  exit;
}

// 로그인 했는데 login/join/home이면 main으로 보냄
if (isset($_SESSION['uid']) && ($p === 'login' || $p === 'join' || $p === 'home')) {
  header("Location: index.php?p=main");
  exit;
}
?>
<!doctype html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <title>통합 페이지</title>
  <style>
    body { margin:0; font-family: Arial, "Malgun Gothic", sans-serif; }
    .nav { display:flex; gap:12px; padding:12px; background:#f3f3f3; border-bottom:1px solid #ddd; position: sticky; top:0; }
    .nav a { text-decoration:none; color:#111; padding:6px 10px; background:#fff; border:1px solid #ddd; border-radius:8px; }
    .wrap { padding: 12px; }
    .right { margin-left:auto; display:flex; gap:10px; align-items:center; }
    .badge { padding:4px 8px; border:1px solid #ddd; border-radius:999px; background:#fff; }
  </style>
</head>
<body>

  <div class="nav">
    <a href="index.php?p=home" style="<?=active('home',$p)?>">홈</a>
    <a href="index.php?p=login" style="<?=active('login',$p)?>">로그인</a>
    <a href="index.php?p=game" style="<?=active('game',$p)?>">게임</a>
    <a href="index.php?p=diary" style="<?=active('diary',$p)?>">다이어리 작성</a>
    <a href="index.php?p=content" style="<?=active('content',$p)?>">다이어리 목록</a>
    <a href="index.php?p=help" style="<?=active('help',$p)?>">도움</a>

    <div class="right">
      <span class="badge">UID: <?= htmlspecialchars($_SESSION['uid'] ?? 'guest') ?></span>
      <?php if (isset($_SESSION['uid'])): ?>
        <a href="logout.php">로그아웃</a>
      <?php endif; ?>
    </div>
  </div>

  <div class="wrap">
    <?php
      switch ($p) {
        case 'login':
          include __DIR__ . '/login.html';
          break;

        case 'game':
          include __DIR__ . '/game.html';
          break;

        case 'diary':
          include __DIR__ . '/diary.html';
          break;

        case 'content':
          include __DIR__ . '/content.php';
          break;

        case 'help':
          include __DIR__ . '/help.html';
          break;

        case 'main':
          // ✅ main.html 없을 가능성 높아서 game으로 시작
          include __DIR__ . '/game.html';
          break;

        case 'home':
        default:
          echo "<h2>통합 페이지 홈</h2>";
          echo "<p>상단 메뉴로 이동하면 됩니다.</p>";
          break;
      }
    ?>
  </div>
</body>
</html>

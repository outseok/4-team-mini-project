<?php
include "dbconn.php";

$uname  = trim($_POST['uname'] ?? '');
$uid    = trim($_POST['uid'] ?? '');
$upw    = trim($_POST['upw'] ?? '');
$reupw  = trim($_POST['reupw'] ?? '');
$umail  = trim($_POST['umail'] ?? '');

if ($uname === '' || $uid === '' || $upw === '' || $umail === '') {
    echo "<script>alert('필수 항목을 모두 입력해주세요.'); location.href='userjoin.html';</script>";
    exit;
}
if ($upw !== $reupw) {
    echo "<script>alert('패스워드 불일치!'); location.href='userjoin.html';</script>";
    exit;
}

$ip = $_SERVER['REMOTE_ADDR'] ?? '';

$dir = "image/";
$uimage = $dir . "profile.png"; // 기본 프로필

if (isset($_FILES['ufile']) && $_FILES['ufile']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['ufile']['name'], PATHINFO_EXTENSION);
    $ext = strtolower($ext);
    $allowed = ['jpg','jpeg','png','gif','webp'];
    if (in_array($ext, $allowed, true)) {
        $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $uid);
        $filename = $safeName . "_profile_" . time() . "." . $ext;
        $target = $dir . $filename;
        if (move_uploaded_file($_FILES['ufile']['tmp_name'], $target)) {
            $uimage = $target;
        }
    }
}

// 중복 체크(아이디/이메일)
$stmt = mysqli_prepare($dbconn, "SELECT uid FROM user_info WHERE uid = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $uid);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
if (mysqli_fetch_assoc($res)) {
    echo "<script>alert('중복된 아이디입니다!'); location.href='userjoin.html';</script>";
    exit;
}

$stmt = mysqli_prepare($dbconn, "SELECT uemail FROM user_info WHERE uemail = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $umail);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
if (mysqli_fetch_assoc($res)) {
    echo "<script>alert('중복된 이메일입니다!'); location.href='userjoin.html';</script>";
    exit;
}

// 가입
$point = 0;
$stmt = mysqli_prepare($dbconn, "INSERT INTO user_info (uname, uid, upw, uemail, point, ip, uimage) VALUES (?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssssiss", $uname, $uid, $upw, $umail, $point, $ip, $uimage);
$ok = mysqli_stmt_execute($stmt);

if ($ok) {
    // 가입 후 바로 마이페이지로 이동(표시용)
    header("Location: mypage.php?uid=" . urlencode($uid));
    exit;
} else {
    echo "<script>alert('오류 발생!'); location.href='userjoin.html';</script>";
    exit;
}
?>

<?php
session_start();
include "dbconn.php";

$uid = $_POST['uid'] ?? '';
$upw = $_POST['upw'] ?? '';

$uid = trim($uid);
$upw = trim($upw);

if ($uid === '' || $upw === '') {
    echo "<script>alert('아이디/비밀번호를 입력해주세요.'); history.back();</script>";
    exit;
}

// 간단 비교(수업/미니프로젝트용). 비밀번호 해싱을 쓰려면 password_hash/password_verify로 교체하세요.
$stmt = mysqli_prepare($dbconn, "SELECT uid, upw FROM user_info WHERE uid = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $uid);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);

if ($row && $row['upw'] === $upw) {
    $_SESSION['uid'] = $row['uid'];
    echo "<script>alert('로그인 성공!'); location.href='main.php';</script>";
} else {
    echo "<script>alert('회원 정보가 일치하지 않습니다.'); history.back();</script>";
}
?>

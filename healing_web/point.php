<?php
session_start();
include "dbconn.php";

$uid = $_SESSION['uid'] ?? null;
if (!$uid) {
  http_response_code(401);
  echo json_encode(["ok"=>false, "msg"=>"로그인 필요"]);
  exit;
}

$add = 0;
if (isset($_POST['mode']) && $_POST['mode'] === 'egg') $add = 100;
if (isset($_POST['finish'])) $add = 500;

if ($add <= 0) {
  echo json_encode(["ok"=>false, "msg"=>"잘못된 요청"]);
  exit;
}

$stmt = mysqli_prepare($dbconn, "UPDATE user_info SET point = point + ? WHERE uid = ?");
mysqli_stmt_bind_param($stmt, "is", $add, $uid);
$ok = mysqli_stmt_execute($stmt);

echo json_encode(["ok"=>$ok, "add"=>$add]);
?>

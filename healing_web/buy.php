<?php
session_start();
include "dbconn.php";

$uid = $_SESSION['uid'] ?? null;
if (!$uid) {
  echo "<script>alert('로그인 후 이용해주세요.'); location.href='login.html';</script>";
  exit;
}

$type  = $_POST['type']  ?? '';
$price = (int)($_POST['price'] ?? 0);
$item  = $_POST['item'] ?? ''; // 선택 아이템(선택 없으면 기본 매핑)

$type = trim($type);
$item = trim($item);

$catalog = [
  'tree' => [
    500  => ['smalltree',  'image/smalltree.png'],
    1000 => ['middletree', 'image/middletree.png'],
    2000 => ['bigtree',    'image/bigtree.png'],
  ],
  'house' => [
    500  => ['house',      'image/house.png'],
    1000 => ['stonehouse', 'image/stonehouse.png'],
    2000 => ['treehouse',  'image/treehouse.png'],
  ],
  'pet' => [
    1500 => ['cat', 'image/cat.png'],
    1501 => ['dog', 'image/dog.png'], // store.html에서 item=dog면 1501로 변환해서 처리
  ],
];

if (!isset($catalog[$type])) {
  echo "<script>alert('잘못된 아이템 타입'); location.href='store.html';</script>";
  exit;
}

// pet은 cat/dog 구분을 위해 item 값을 사용
if ($type === 'pet') {
  if ($item === 'dog') $price = 1501;
  else $price = 1500; // default cat
}

if (!isset($catalog[$type][$price])) {
  echo "<script>alert('잘못된 가격'); location.href='store.html';</script>";
  exit;
}

[$name, $image] = $catalog[$type][$price];
$realPrice = ($type === 'pet' ? 1500 : $price);

// 포인트 확인
$stmt = mysqli_prepare($dbconn, "SELECT point FROM user_info WHERE uid = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $uid);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
$cur = (int)($row['point'] ?? 0);

if ($cur < $realPrice) {
  echo "<script>alert('포인트가 부족합니다!'); location.href='store.html';</script>";
  exit;
}

// 차감
$stmt = mysqli_prepare($dbconn, "UPDATE user_info SET point = point - ? WHERE uid = ?");
mysqli_stmt_bind_param($stmt, "is", $realPrice, $uid);
mysqli_stmt_execute($stmt);

// 내 아이템(장착) upsert
$stmt = mysqli_prepare($dbconn, "INSERT INTO myitem (uid, type, name, image) VALUES (?, ?, ?, ?)
  ON DUPLICATE KEY UPDATE name=VALUES(name), image=VALUES(image)");
mysqli_stmt_bind_param($stmt, "ssss", $uid, $type, $name, $image);
mysqli_stmt_execute($stmt);

echo "<script>alert('구매 완료!'); location.href='main.php';</script>";
?>

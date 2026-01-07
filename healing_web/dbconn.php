<?php
// dbconn.php - 공통 DB 연결 파일
// ※ 개발환경(XAMPP 등) 기준: root / 비밀번호 없음
// DB 이름은 schema.sql 실행 후 생성되는 'heal' 을 사용합니다.

$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "heal";

$dbconn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (!$dbconn) {
    die("DB 연결 실패: " . mysqli_connect_error());
}
mysqli_set_charset($dbconn, "utf8");
?>

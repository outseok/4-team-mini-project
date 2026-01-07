<?php
session_start();

/*
  login_process.php
  - DB: user
  - Table: user_info
  - Columns assumed: uid, upw, (others...)
*/

$dbconn = mysqli_connect('localhost', 'root', '', 'user');
if (!$dbconn) {
    die('DB 연결 실패: ' . mysqli_connect_error());
}

// POST 값 안전하게 받기
$uid = $_POST['uid'] ?? '';
$upw = $_POST['upw'] ?? '';

// POST로 안 들어온 경우(직접 접속/폼 name 불일치 등)
if ($uid === '' || $upw === '') {
    echo "<script>
        alert('아이디/비밀번호가 전달되지 않았습니다. 로그인 페이지에서 다시 시도하세요.');
        history.back();
    </script>";
    exit;
}

// (선택) 한글 깨짐 방지
mysqli_set_charset($dbconn, 'utf8');

// ✅ SQL (테이블: user_info, 비번 컬럼: upw)
$sql = "SELECT * FROM user_info WHERE uid='$uid' AND upw='$upw'";
$result = mysqli_query($dbconn, $sql);

// ✅ 쿼리 실패 시 원인 출력 (개발 중에만 쓰고, 배포 시 제거 권장)
if ($result === false) {
    die('SQL 오류: ' . mysqli_error($dbconn));
}

$row = mysqli_fetch_assoc($result);

if ($row) {
    session_regenerate_id(true);
    $_SESSION['uid'] = $row['uid'];

    echo "<script>
        alert('로그인 성공하였습니다.');
        location.href='index.php?p=main';
    </script>";
} else {
    echo "<script>
        alert('회원 정보가 일치하지 않습니다. 다시 시도해주세요.');
        history.back();
    </script>";
}

mysqli_close($dbconn);
exit;
?>

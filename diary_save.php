<<!DOCTYPE html>
    <html lang="ko">

    <head>
        <meta charset="utf-8">
        <title>다이어리</title>
    </head>

    <?php
    include "dbconn.php";
    session_start();
    if (!isset($_SESSION['uid'])) {
        echo "<script>alert('로그인 후 이용해주시기 바랍니다.'); location.href='login.php';</script>";
        exit;
    }
    $sql = "SELECT * FROM diary WHERE uid = '$uid' ORDER BY reg_date DESC";
    $uid = $_SESSION['uid'];
    $title = $_POST['title'];
    $emotion = $_POST['emotion'];
    $content = $_POST['content'];
    $event_date = $_POST['event_date'];


    $sql = "INSERT INTO diary (uid, title, emotion, content, event_date, reg_date) 
        VALUES ('$uid', '$title', '$emotion', '$content', '$event_date', NOW())";

    if (mysqli_query($dbconn, $sql)) {
        echo "<script>
            alert('오늘의 기록이 저장되었습니다! 편안하게 하루를 마무리해보세요!');
            location.href='content.php'; 
          </script>";
    } else {
        echo "저장에 실패하였습니다." . mysqli_error($dbconn);
    }

    mysqli_close($dbconn);
    ?>

    </html>
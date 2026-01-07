
<?php
include "dbconn.php";
session_start();
if (!isset($_SESSION['uid'])) {
    echo "<script>alert('로그인 후 이용해주시기 바랍니다.'); location.href='login.php';</script>";
    exit;
}
$uid = $_SESSION["uid"];
$sql = "SELECT * FROM diary WHERE uid = '$uid' ORDER BY reg_date DESC";
$result = mysqli_query($dbconn, $sql);

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <title>나의 감정 기록 목록</title>
    <style>
        body {
            font-family: 'Malgun Gothic', sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .diary-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-left: 5px solid pink;
        }

        .diary-date {
            font-size: 0.9em;
            color: #888;
        }

        .diary-title {
            font-size: 1.2em;
            font-weight: bold;
            margin: 10px 0;
        }

        .diary-emotion {
            color: #ff69b4;
            font-weight: bold;
        }

        .diary-content {
            line-height: 1.6;
            color: #444;
        }

        .re-Btn {
            padding: 10px 20px;
            background: pink;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: black;

        }
    </style>
</head>

<body>

    <div class="container">
        <h2>나의 감정 돌아보기🗃️</h2>
        <a href="diary.html" class="re-Btn">돌아가기</a>
        <hr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='diary-card'>";
                echo "<div class='diary-date'>" . $row['event_date'] . " (작성시간: " . $row['reg_date'] . ")</div>";
                echo "<div class='diary-title'>" . htmlspecialchars($row['title']) . " <span class='diary-emotion'>[" . $row['emotion'] . "]</span></div>";
                echo "<div class='diary-content'>" . nl2br(htmlspecialchars($row['content'])) . "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>아직 작성된 일기가 없습니다.</p>";
        }
        mysqli_close($dbconn);
        ?>
    </div>
</body>

</html>
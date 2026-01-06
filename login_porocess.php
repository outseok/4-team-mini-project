<!DOCTYPE html>
<html lang = "ko">

<head>
    <meta charset="UTF-8">
    <title>로그인</title>
    </head>

<style>
    *{margin: 0; padding: 0;}*
    body{background-color: rgba(220,241,254,0.8);}
</style>
<body>
    
    <?php
    session_start();
    


    $dbconn = mysqli_connect('localhost', 'root', "", "team01");
    mysqli_select_db($dbconn, 'team01');
    $uid = $_POST['uid'];
    $upw = $_POST['upw'];

    $sql = "select * from member where uid = '$uid' and pw='$upw'";
    $result = mysqli_query($dbconn, $sql);
    $row = mysqli_fetch_array($result);
    if ($row){
       $_SESSION["uid"] = $row['uid'];
        echo "<script>alert('로그인 성공하였습니다.'); location.href='diary.html';</script>";
    }else{
            echo "<script>alert('회원 정보가 일치하지 않습니다.'.'\n','다시 시도해주세요.');history.back();</script>";
        }
    ?>

</body>

</html>
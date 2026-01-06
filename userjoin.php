<!DOCTYPE html>
<html lang = 'ko'>
    <head>
        <meta charset = 'UTF-8'>
        <title> DATA </title>
    </head>
    <body>
        <?php
        $uname = $_POST['uname'];
        $uid = $_POST['uid'];
        $upw = $_POST['upw'];
        $reupw = $_POST['reupw'];
        $umail = $_POST['umail'];

        if($upw != $reupw){
            echo "패스워드 불일치!";
            echo "<form action = 'userjoin.html' method = 'post'>
            <input type = 'submit' value = '돌아가기>";
        }else{
            $dbcon = mysqli_connect('localhost', 'root', '');
            mysqli_select_db($dbcon, 'user');

            $query = "insert into user_info value(null, '$uname', '$uid', '$upw', '$umail')";
            $result = mysqli_query($dbcon, $query);

            if(isset($result)){
                echo "<script>alert('회원가입 성공!')
                location.href = 'loginphp' </script>";
            }else{
                echo "<script> alert('오류 발생!') </script>";
                echo "<script> location.href = 'php' </script>";
            }
        }


        ?>
    </body>
</html>
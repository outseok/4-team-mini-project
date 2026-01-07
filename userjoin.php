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
<<<<<<< HEAD

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
                location.href = 'login.html' </script>";
=======
        $point = 0;
        $ip = $_SERVER['REMOTE_ADDR'];
        $dir = "image/";
        $chid = 0;

        $img_info = pathinfo($_FILES['ufile']['name']);
        $img_name = $img_info['filename']; 
        $img_ext = $img_info['extension'];
        $imagepath = $dir . $img_name . "." . $img_ext;
        move_uploaded_file($_FILES['ufile']['tmp_name'], $imagepath);

        $dbcon = mysqli_connect('localhost', 'root', '');
        mysqli_select_db($dbcon, 'user');
        $ch_query = "select uid from user_info where uid = '$uid'";
        $ar_id = mysqli_query($dbcon, $ch_query);
        $ch_id = mysqli_fetch_array($ar_id);

        $mail_query = "select uemail from user_info where uemail = '$umail'";
        $ar_mail = mysqli_query($dbcon, $mail_query);
        $ch_mail = mysqli_fetch_array($ar_mail);

        if($upw != $reupw){
            echo "<script>alert('패스워드 불일치!');</script>";
            echo "<script> location.href = 'userjoin.html' </script>";
        }else if($ch_id['uid'] == $uid){
            echo "<script>alert('중복된 아이디입니다!');</script>";
            echo "<script> location.href = 'userjoin.html' </script>";
        }else if($ch_mail['uemail'] == $umail){
            echo "<script>alert('중복된 이메일입니다!');</script>";
            echo "<script> location.href = 'userjoin.html' </script>";
        }else{
            $query = "insert into user_info value(null, '$uname', '$uid', '$upw', '$umail', '$point', '$ip', '$imagepath')";
            $result = mysqli_query($dbcon, $query);
        }
            if(isset($result)){
                echo "<script>alert('회원가입 성공!') 
                location.href = 'mypage.php?uid=".$uid." &uname=".$uname." &ip=".$ip." &ufile=".$imagepath."' </script>";
>>>>>>> 6fe0b66811033990267d26c91cada475b405f3c3
            }else{
                echo "<script> alert('오류 발생!') </script>";
                echo "<script> location.href = 'userjoin.html' </script>";
            }
<<<<<<< HEAD
        }


        ?>
=======
            mysqli_close($dbcon);
        ?>
        
>>>>>>> 6fe0b66811033990267d26c91cada475b405f3c3
    </body>
</html>
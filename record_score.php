<!DOCTYPE html>
<html>
    <head>
        <meta charset = 'UTF-8'>
        <title>healing island</title>
        <style>
            body {
                background-image: url('./image/back.png');
                background-repeat:no-repeat;
                background-size:cover;
            }
            
            table1 { 
                background-color: rgba(192, 192, 192, 0.6);
                width: 100px;
                text-align: center;
                position: absolute;
                top: 0;
                right: 0;
            }
            div2 {

            }
        </style>
        
    </head>
    <body>
        <?php
        $point = $_POST['point'];

        $dbcon = mysqli_connect('localhost', 'root', '');

        mysqli_select_db($dbcon, 'heal');
        $query1 = "update point set point = point + $point where uid = 124";
        //update user_info set point = $point where uid == $uid
        mysqli_query($dbcon, $query1);
        mysqli_close($dbcon);
        Header("Location:./main.php");
        ?>

    </body>
</html>
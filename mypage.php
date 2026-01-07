<!DOCTYPE html>
<html lang='ko'>

<head>
    <meta charset='UTF-8'>
    <title> DATA </title>
        <!-- <style>
            input[type = 'text'], input[type = 'password']{
                background-color: rgb(253, 202, 182);
            }
        </style> -->
</head>

<body background="background.png" style='background-repeat: no-repeat; background-size: cover;'>
    <marquee scrollamount = '3'>
        <img src = './web/cloud.png' width="300px" height="200px">
    </marquee>
     <table border='0' cellpadding='40' rowpadding='10'
            style="background-color: rgb(246, 241, 241, 0.5); margin: auto;margin-top: -5%;border-radius: 15%;">
            <tr>
                <td style="position: relative; height: 50px;text-align: right;">
                    <?php
                    $image = $_GET['ufile'];
                    $userid = $_GET['uid'];
                    $username = $_GET['uname'];
                    $uip = $_GET['ip'];
                    echo "
                    <center>
                        <img src = '$image' width = '130' height = '130'><br><br>
                    </center>";
                    echo "이름 <input type='text' name='uname' value='$username' disabled> <br><br>";
                    echo "아이디 <input type ='text' name='uid' value='$userid' disabled><br><br>";
                    echo "비밀번호 <input type='text' name='upw' value = '********' disabled><br><br>";
                    echo "IP <input type='text' name='ip' value= '$uip' disabled><br><br>";
                    ?>
                </td>
            </tr>
        </table>
    </body>
</html>
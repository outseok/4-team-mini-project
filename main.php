<?php
session_start();

$db = mysqli_connect('localhost', 'root', '', 'heal');
mysqli_set_charset($db, 'utf8');
$id = '124';

$query = "select point from point where uid = '$id'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);

$point = $row['point'] ?? 0;
mysqli_close($db);
?>
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
                width: '800';
                height: '400'; 
                margin: auto; 
                margin-top: 20%; 
                margin-right: 24%; 
                margin-bottom: 10%;
                text-align: center;
                background-color: rgba(192, 192, 192, 0.6);
            }
            #m{
                text-align: left;
            }
        </style>
        <script>
            
            let np = 0;
            function cloud() {
                    
                np += 3;
                point.value = np;
                h_point.value = np;
                    
            }   
            function cloud2() {
                    
                np += 2;
                point.value = np;
                h_point.value = np;
                    
            }  
            function cloud3() {
                    
                np += 1;
                point.value = np;
                h_point.value = np;
                    
            }  
        </script>

    </head>
    <body>
        <fieldset style = "width:100px; position: absolute; right: 7%; top: 10px;" >
            <legend style="border-color:aliceblue; background-color: rgba(0,0,0,1,); ">Point</legend>
                <input type = 'text' id = 'point' value = '<?php echo $point; ?>' name = 'point' readonly>

                <form action = './record_score.php' method = 'post'>
                    <input type = 'hidden' id = 'h_point' name = 'point'>
                    <input type = 'submit' value = '저장'>
                </form>
                
        </fieldset>
        <p>
            <table1>
                <tr>
                    <td>
                        <a href = './main.php'>
                            <img src = './image/home.png' title = '홈' width = '80' height = '80'>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href = './store.html'>
                            <img src = './image/store.png' title = '상점' width = '80' height = '80'>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href = './game.html'>
                            <img src = './image/game.png' title = '미니게임' width = '80' height = '80'>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href = './help.html'>
                            <img src = './image/speech.png' title = '도움 페이지' width = '80' height = '80'>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href = './diary.html'>
                            <img src = './image/diary.png' title = '다이어리' width = '85' height = '85'>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href = './profile.html'>
                            <img src = './image/profile.png' title = '프로필' width = '80' height = '80'>
                        </a>
                    </td>
                </tr>
            </table1><br>
        </p>
        <div id = 'm'>
            <marquee direction = 'right' width = '80%' height = '80' scrollamount = '10n'>
                <img src = './image/cloud.png' title = '날 클릭해봐' width = '100' onclick = cloud()>&nbsp;&nbsp;
                <img src = './image/cloud2.png' title = '날 클릭해봐' width = '100' onclick = cloud()>
            </marquee>
            <marquee direction = 'left' width = '90%' height = '80' scrollamount = '6n'>
                <img src = './image/cloud2.png' title = '날 클릭해봐' width = '100' onclick = cloud2()>
                <img src = './image/cloud.png' title = '날 클릭해봐' width = '100' onclick = cloud2()>
            </marquee>
            <marquee direction = 'right' width = '90%' height = '80' scrollamount = '3n'>
                <img src = './image/cloud.png' title = '날 클릭해봐' width = '100' onclick = cloud3()>
            </marquee>

        </div>
        <div2 style = 'background-color: rgba(192, 192, 192, 0.6);'>
            <?php
            

            $dbcon = mysqli_connect('localhost', 'root', '');

            mysqli_select_db($dbcon, 'heal');
            $query1 = "select image from myitem where type = 'tree'";
            $query2 = "select image from myitem where type = 'house'";
            $query3 = "select image from myitem where type = 'pet'";
            
            $result1 = mysqli_query($dbcon, $query1);
            $result2 = mysqli_query($dbcon, $query2);
            $result3 = mysqli_query($dbcon, $query3);
            
            $row1 = mysqli_fetch_array($result1);
            $row2 = mysqli_fetch_array($result2);
            $row3 = mysqli_fetch_array($result3);
            echo "<table>
                <tr>
                    <td width = '450' text-align = 'center' >
                        <img src = '{$row1['image']}' height = '400' width = '300'>
                    </td>
                    <td width = '450'>
                        <img src = '{$row2['image']}' height = '400' width = '400'>
                    </td>
                    <td width = '450'>
                        <img src = '{$row3['image']}' height = '400' width = '400'>
                    </td>
                </tr>
            </table>";
            mysqli_close($dbcon);
            ?>
        </div2>

            
        

    </body>
</html>
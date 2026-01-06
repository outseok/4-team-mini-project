<!DOCTYPE html>
<html>
    <head>
        <meta charset = 'UTF-8'>
        <title>STORE</title>
    </head>
    <body>
        <?php
        $price = $_POST['price'];
        $type = $_POST['type'];
        $uid = '124';

        $dbcon = mysqli_connect('localhost', 'root', '', 'heal');
        $query2 = "select point from point where uid = $uid";
        $result2 = mysqli_query($dbcon, $query2);
        $row_result = mysqli_fetch_array($result2);
        $np = $row_result['point'];

        $query_item = "select image from item where type = '$type' AND price = $price";
        $result_item = mysqli_query($dbcon, $query_item);
        $row_item = mysqli_fetch_array($result_item);
        $image_path = $row_item['image'];

        $query = "select price from item where type = '$type' AND price = $price";
        $result = mysqli_query($dbcon, $query);
        $query2 = "select point from point where uid = $uid";
        $result2 = mysqli_query($dbcon, $query2);
        if($price > $np){
            echo "
            <script>
                alert('포인트가 부족합니다');
            </script>";
            }else{
            $query1 = "update point set point = point - $price where uid = $uid";
            mysqli_query($dbcon, $query1);
            $ok = "select * from myitem";
            $rok = mysqli_query($dbcon, $ok);
            $roka = mysqli_fetch_array($rok);
            if($roka['uid'] != $uid){
                $ins = "insert into myitem value('$uid', '$type', '$type', '$image_path')";
                mysqli_query($dbcon, $ins);
                
            }else{
                $mv = "update myitem set image = '$image_path' where type = '$type'";
                mysqli_query($dbcon, $mv);
            }
            
        }
        

        Header("Location:./store.php");
        mysqli_close($dbcon);
        ?>

    </body>
</html>
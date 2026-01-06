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

        $dbcon = mysqli_connect('localhost', 'root', '');
        $query2 = "select point from point where uid = $uid";
        $result2 = mysqli_query($dbcon, $query2);
        $row_result = mysqli_fetch_array($result2);
        $np = $row_result['point'];

        $query_item = "select image from item where type = '$type'";
        $result_item = mysqli_query($dbcon, $query_item);
        $row_item = mysqli_fetch_array($result_item);
        $image_path = $row_item['image'];
        $imagepath = "./image/".$image_path;

        // $image_info = pathinfo($_FILES['image']['name']);
        // $image_name = $image_info['filename'];
        // $image_ext = $image_info['extension'];
        // $image

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
            $move = "update myitem set uid = $uid AND image = '$image_path' where type = '$type'";
            mysqli_query($dbcon, $move);
        }
        

        Header("Location:./store.php");
        mysqli_close($dbcon);
        ?>

    </body>
</html>
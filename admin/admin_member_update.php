<?php

//get 과 post를 동시에 쓸 수 있따. 
$num = $_GET['num'];
$level = $_POST['level'];
$point = $_POST['point'];

include "../lib/dbconn.php";

$sql = "UPDATE member SET level=$level, point=$point WHERE num=$num" ; //num이 숫자라 ''를 안써도 된다 써도 된다.
mysqli_query($conn,$sql);
mysqli_close($conn);

echo "
    <script>
        location.href='./admin.php';
    </script>

";


?>
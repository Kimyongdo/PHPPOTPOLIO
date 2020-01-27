<?php

//체크박스는 여러개 체크하지 않았을 수 있음. 
// 체크박스 누르지 않고 삭제 누르는 경우
if(!isset($_POST['items'])){
    echo "
        <script>
            alert('삭제할 게시글을 선택하세요.');
            history.go(-1);
            </script>

    ";
    exit;
}

//db연결
include "../lib/dbconn.php";

//전달받은 체크박스의 값들을 배열로 받습니다.

$items = $_POST['items'];

//$items는 체크된 항목들의 게시글 num을 가진 배열변수임
//전달된 게시글의 num의 개수를 알아내기[배열의 길이를 알아내는 count()]
$itemNum = count($items);


for($i=0; $i<$itemNum; $i++){
    $num = $items[$i];

    //업로드된 파일도 삭제하고 싶다면..
    $sql = "SELECT * FROM board WHERE num=$num";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $copied_name = $row['file_copied']; //지정된 파일명
    if($copied_name){ //파일이 있다면
        $file_path = "../board/uploads/".$copied_name;
        unlink($file_path);
    }



    //db에서 해당하는 게시글 삭제하는 쿼리 작성
    $sql = "DELETE FROM board WHERE num=$num";
    mysqli_query($conn,$sql);

}
mysqli_close($conn);


echo"
    <script>
        location.href='./admin.php';
    </script>
";


?>
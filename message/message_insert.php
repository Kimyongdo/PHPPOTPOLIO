<?php

//GET방식으로 전달된 id
$send_id = $_GET['send_id'];

// post방식으로 전달된 다른 값들
$rv_id=$_POST['rv_id'];
$subject=$_POST['subject'];
$content=$_POST['content'];

//쪽지 보낸 시간 
$regist_day=date("Y-m-d (H:i)");

//message 테이블에 저장하기
include "../lib/dbconn.php";

//수신아이디가 존재하는지
$sql = "SELECT * FROM member WHERE id='$rv_id'";
$result = mysqli_query($conn,$sql);
$rowNum = mysqli_num_rows($result);

if($rowNum){
    //message테이블 저장
    $sql = "INSERT INTO message(send_id,rv_id,subject,content,regist_day) ";//띄어쓰기 필수
    $sql .="VALUES('$send_id','$rv_id','$subject','$content','$regist_day')";
    mysqli_query($conn,$sql);
    

}else{
    echo"
    <script>
        alert('수신 아이디가 잘 못 되었습니다.');
        history.back();
    </script>
        ";
exit;
}

mysqli_close($conn);

// 우선은 뒤로 돌아가기 즉 메세지 작성페이지로 이동 
// 원래는 송신페이지로 이동 
// echo"
//     <script>
//     history.back();
//     </script>
// ";

echo"
    <script>
    location.href='./message_box.php?mode=send';
    </script>
";

?>
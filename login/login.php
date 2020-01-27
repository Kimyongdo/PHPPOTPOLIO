<?php

$id = $_POST['id'];
$pass = $_POST['pass'];

//아이디와 비밀번호 입력여부 확인
if(!$id){
    //경고창 보여주고 이전페이지로 이동 [JS의 history객체 이동]
    echo"
        <script>
        alert('아이디를 입력하세요');
        history.go(-1);
        </script>
    ";
    //  history.go(-1); == history.back 이전페이지로 이동
    exit;
}

if(!$pass){
    //경고창 보여주고 이전페이지로 이동 [JS의 history객체 이동]
    echo"
        <script>
        alert('비밀번호를 입력하세요');
        history.go(-1);
        </script>
    ";
    //  history.go(-1); 이전페이지로 이동
    exit;
}

//exit가 안되었다면 아아디와 비번 전달된것이므로
//DB에서 해당 ID와 비번을 체크

//DB접속 공통모듈
include "../lib/dbconn.php";
// 테이블이름 <-같은 이름이 맞다면
$sql="SELECT * FROM member WHERE id='$id' && pass='$pass'";
$result = mysqli_query($conn,$sql);
//결과로부터 레코드 수얻어오기
$rowNum= mysqli_num_rows($result);

//$rowNum이 0이면 아이디와 패스워드가 맞지 않음. 
if(!$rowNum){
    echo"
        <script>
            alert('아이디와 비밀번호를 확인하세요');
            history.back;
        </script>
    ";
    exit;
}

//exit가 안되어있다면 로그인이 되었다는 것임!!
//다른페이지에서 로그인이 되었다는 것을 인지하기 위해
//회원정보를 세션에 저장
//해당하는 아이디의 회원정보 얻어오기
// 연관배열로 가져오겠다  == MYSQLI_ASSOC
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

//세션에 저장하기
session_start();
$_SESSION['userid']=$row['id'];
$_SESSION['username']=$row['name'];
$_SESSION['userlevel']=$row['level'];
$_SESSION['userpoint']=$row['point'];

//세션에 저장되었으니 index.php 페이지로 이동
echo "
    <script>
        location.href='../index.php';
    </script>
";


?>
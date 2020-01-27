<?php
session_start();

//변수없애기
unset($_SESSION['userid']);
unset($_SESSION['username']);
unset($_SESSION['userlevel']);
unset($_SESSION['userpoint']);

//index페이지로 돌아가기
echo "
    <script>
        location.href='../index.php';
    </script>
";


?>
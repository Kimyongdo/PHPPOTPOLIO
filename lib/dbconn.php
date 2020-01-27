<?php

$conn= mysqli_connect('localhost', 'chocojoa1234', 'chocojoa12!', 'chocojoa1234');
    // $conn= mysqli_connect('localhost', 'haha', '1234', 'hp_db');
    // 한글깨짐 방지 쿼리실행
    mysqli_query($conn, "set names utf8");

?>
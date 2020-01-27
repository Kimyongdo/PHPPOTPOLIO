<!-- message_form.php를 복사해서 가져오기 -->

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>쪽지</title>

    <!-- 공통스타일 -->
    <link rel="stylesheet" href="../css/common.css">;
    <!-- 쪽지작성 페이지의 전용 스타일  -->
    <link rel="stylesheet" href="../css/message.css">;
</head>

<body>
    <header>
        <?php include "../lib/header2.php"?>
    </header>

    <section>
        <div id="main_content">
            <div id="message_box">
                <h3 id="write">답변 쪽지 보내기</h3>
                    <!-- 쪽지함 이동 버튼 영역 -->
                    <!-- 여기 부분 삭제됨 -->
                    <!-- message insert.php를 통해 BD의 message 테이블에 저장 -->
                    <form action="./message_insert.php?send_id=<?=$userid?>" method="post" name="message_form">
                    <!-- 답변 쪽지 화면에는 답변할 쪽지의 내용이 이미 작성되어있음 -->
                    <!-- 그래서 답변할 쪽지의 내용을 message테이블에서 읽어오기 -->
                    <?php
                        //답변할 쪽지 번호 얻어오기
                        $num=$_GET['num'];
                        include "../lib/dbconn.php";
                        $sql = "SELECT * FROM message WHERE num=$num";
                        $result = mysqli_query($conn,$sql);

                        // 결과표에서 해당 데이터 레코드 배열로 읽어오기
                        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                        $send_id=$row['send_id'];
                        $rv_id=$row['rv_id'];
                        $subject=$row['subject'];
                        $content=$row['content'];

                        //답변 제목은 RE: 글자가 추가 표시되도록 
                        $subject ="RE: ".$subject;

                        //보낸글과 내가 작성하는 글을 구별하기 위해서
                        //보낸글 앞에 > 표시추가 및 줄바굴때마다 > 추가
                        $content = ">".$content;
                        $content = str_replace("\n","\n>",$content); // 줄바꿈+>

                        //구분선 추가
                        $content = "\n\n\n------------------------------------\n".$content; // \n로 세줄확보
                        mysqli_close($conn);

                    ?>

                        <div id="write_msg">
                            <ul>
                                <li>
                                    <span class="col1">보내는 사람 : </span>
                                    <span class="col2"><?=$userid?></span>
                                </li>

                                <li>
                                    <span class="col1">수신 아이디 : </span>
                                    <span class="col2"><?=$send_id?></span>
                                    <!-- 수신아이디는 input요소를 이용하지 않기 때문에 post 전달되지 않음. 
                                    그래서 보이지는 않지만 form에 의해서 자동전송되는 type="hidden"을 사용 (get으로 보내면 보여지니까 안보여지고싶을때)
                                -->
                                <input type="hidden" name="rv_id" value="<?=$send_id?>">
                                </li>

                                <li>
                                    <span class="col1">제목 :</span>
                                    <span class="col2"><input type="text" name="subject" value="<?=$subject?>"></span>
                                </li>

                                <li id="textarea">
                                    <span class="col1">내용 :</span>
                                    <span class="col2"><textarea name="content"><?= $content?></textarea></span>
                                </li>
                                
                            </ul>

                            <!-- 서밋버튼 -->
                            <input type="submit" value="보내기">

                        </div>
                </form>
            </div>
        </div>
    </section>

    <footer>
    <?php include "../lib/footer.php"?>
    </footer>

</body>
</html>
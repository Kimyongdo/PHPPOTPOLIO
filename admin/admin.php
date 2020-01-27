<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>관리자모드</title>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <header>
    <?php include "../lib/header2.php"?>
    </header>

    <section>
        <div id="main_content">
            <div id="admin_box">
                <!-- 1. 회원정보 관리 -->
                    <h3>관리자모드 > 회원관리</h3>
                    <!-- 회원명단 관리표 모양-->
                    <ul id="member_list">
                        <!-- 표의 제목줄 -->
                        <li>
                            <span class="col1">번호</span>
                            <span class="col2">아이디</span>
                            <span class="col3">이름</span>
                            <span class="col4">레벨</span>
                            <span class="col5">포인트</span>
                            <span class="col6">가입일</span>
                            <span class="col7">수정</span>
                            <span class="col8">삭제</span>
                        </li>

                        <!-- 제목줄 밑으로 회원정리 한줄씩 출력하기 -->
                        <!-- 회원정보 읽어오는 db코드 작성 -->

                        <?php
                            include "../lib/dbconn.php";
                            $sql = "SELECT * FROM member ORDER BY num desc";
                            $result = mysqli_query($conn, $sql);
                            
                            //for문 대신 while문으로 레코드들 읽어와보기
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                    $num = $row['num'];
                                    $id = $row['id'];
                                    $name = $row['name'];
                                    $level = $row['level'];
                                    $point = $row['point'];
                                    $regist_day = $row['regist_day'];
                            
                                //필드값 출력을 위해 php구문을 분리 
                                ?>

                                <li>

                          

                                    <!-- 수정작업은 form의 submit을 통해서 하고, delte는 그냥 버튼으로 처리하기. -->
                                    <form action="./admin_member_update.php?num=<?=$num?>" method="post">
                                    <span class="col1"><?=$num?></span>
                                     <span class="col2"><?=$id?></span>
                                      <span class="col3"><?=$name?></span>

                                      <!-- level point는 변경이 가능하도록 input요소로  -->
                                        <span class="col4"><input type="text" name=level value="<?=$level?>"></span>
                                         <span class="col5"><input type="text" name=point value="<?=$point?>"></span>
                                          <span class="col6"><?=$regist_day?></span>
                                          <!-- 버튼을 type = submit가능 -->
                                          <span class="col7"><button type="submit">수정</button></span>
                                          <!-- type="button을 써야 submit 안되고 그냥 버튼모양   -->
                                          <span class="col8"><button type="button" onclick="location.href='./admin_member_delete?num=<?$num?>'">삭제</button></span>
                                    </form>
                                </li>
                                <?php
                                }
                                ?>

                        
                    </ul>
                <!-- 2. 게시판 관리 -->
                     <h3>관리자모드 > 게시판 관리</h3>
                                <ul id="board_list">
                                <!-- 표의 제목줄 -->
                                <li class="title">
                                    <span class ="col1">선택</span>
                                    <span class ="col2">번호</span>
                                    <span class ="col3">이름</span>
                                    <span class ="col4">제목</span>
                                    <span class ="col5">첨부파일명</span>
                                    <span class ="col6">작성일</span>
                                </li>
                                
                                <!-- 표의 내용 레코드들 출력 -->
                                <form action="./admin_board_delete.php" method="post">
                                <!-- 보여줄 레코드값들 읽어오기 -->
                                <?php
                                 $sql = "SELECT * FROM board ORDER BY num desc";
                                 $result = mysqli_query($conn, $sql);
                                 while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                     $num = $row['num'];
                                     $name = $row['name'];
                                     $subject = $row['subject'];
                                     $file_name = $row['file_name'];
                                     $regist_day = $row['regist_day'];
                                     //게시판 등록일자만 시간을 제거하기 
                                     $regist_day = substr($regist_day,0,10);//0번 인덱스부터 10번전까지 문자열 잘라내기
                                    
                                    //출력을 위해 php 분리
                                    ?>

                                        <!-- html로 필드값 출력  -->
                                        <li>
                                        <!-- 삭제를 제어하기 위해 체크박스 이용해보기 -->
                                        <!-- name="items[]" -->
                                        <span class ="col1"><input type="checkbox" name="items[]" value="<?=$num?>"></span>
                                       <span class ="col2"><?=$num?></span>
                                         <span class ="col3"><?=$name?></span>
                                         <span class ="col4"><?=$subject?></span>
                                        <span class ="col5"><?=$file_name?></span>
                                        <span class ="col6"><?=$regist_day?></span>
                                        </li>
                                    <?php
                                 }
                                 mysqli_close($conn);
                                ?>
                                
                                <!--선택된 글 삭제버튼 -->
                                <button type="sumbit">선택된 글 삭제</button>
                                </form>
                                
                                </ul>


            </div>
        </div>
    </section>

    <footer>
    <?php include "../lib/footer.php"?>
    </footer>
</body>
</html>
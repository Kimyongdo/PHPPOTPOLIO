        <?php
          include "./lib/dbconn.php";
        ?>

        <!-- 메인 이미지 영역 -->
        <div id="main_img_bar">
            <img src="./img/airplane.png">
        </div>
        <!-- 이미지 아래 최신게시글 표시 영역 -->
        <div id="main_content">
            <!-- 1. 최신게시글 목록 -->
            <article id="latest">
                <h4><a href="./board/board_list.php">최신 게시글</a></h4>


                <ul id=latestuUl>
                   
                    <?php
   
                //시간을 기준으로 가져옴. 
                  $sql= "SELECT * FROM board ORDER BY regist_day desc";
                  $result= mysqli_query($conn, $sql);
                  $rowNum = mysqli_num_rows($result);

  
                  for($i=0; $i<$rowNum; $i++){
                      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                     
                      $subject= $row['subject'];
                      $id= $row['id'];
                      $regist_day= $row['regist_day'];
                      $regist_day=substr($regist_day,0,10);
                      ?>


                      <li>
                          <span class="col1"><a href="./board/board_list.php"><?=$subject?></a></span>
                          <span class="col2"><?=$id?></span>
                          <span class="col3"><?=$regist_day?></span>
                      </li>
                  <?php
                  }
                
              ?>
                </ul>
            </article>

            <!-- 2. 포인트 랭킹 목록 -->
            <article id="point_rank">
                <h4>포인트 랭킹</h4>
                <ul>
                   

                    <?php
                  
                        //최신명단순으로 
                        $sql= "SELECT * FROM member ORDER BY point desc";
                        $result= mysqli_query($conn, $sql);
                        $rowNum = mysqli_num_rows($result);

        
                        for($i=0; $i<$rowNum; $i++){
                            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                           
                            $id= $row['id'];
                            $name= $row['name'];
                            $point= $row['point'];
                            ?>


                            <li>
                                <span class="col1"><?=$i+1?></span>

                                <span class="col2"><?=$id?></span>
                                <span class="col3"><?=$name?></span>
                                <span class="col4"><?=$point?>pt</span>
                            </li>
                        <?php
                        }
                        mysqli_close($conn);
                    ?>


                </ul>
            </article>
        </div>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>로그인</title>

        <!-- 공통사용 스타일 적용 -->
        <link rel="stylesheet" href="../css/common.css">
        <!-- 로그인 전용 스타일 전용 -->
        <link rel="stylesheet" href="../css/login.css">

    </head>

    <body>

        <header>
            <!-- 공통모듈적용 lib-->
            <?php include "../lib/header2.php"?>
        </header>

        <section>
            <div id="main_content">
                <div id="login_box">
                    <div id="login_title">로그인</div>
                    <div id="login_form">
                        <form action="./login.php" method="post">
                            <ul>
                                <li><input type="text" name="id" placeholder="아이디"></li>
                                <li><input type="password" name="pass" placeholder="비밀번호"></li>
                            </ul>
                            <div id="login_btn">
                                <input type="image" src="../img/login.png">
                                <!-- submit도 가능 -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <!-- 공통모듈 lib -->
            <?php include "../lib/footer.php"?>
        </footer>

    </body>

</html>
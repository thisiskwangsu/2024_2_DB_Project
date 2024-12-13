<?php   
    include("DB/dbconn.php");

    $logged_in = isset($_SESSION['ss_mb_id']); //참, 로그인 상태인지 아닌지 확인하는 불변수
    /* $user_name = $logged_in ? $_SESSION['ss_mb_id'] : null; */

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }
    </style>
</head>

<body>
    <script src="./js/main.js" type="module"></script>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">축구 유니폼 홈쇼핑</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">홈</a>
                    </li>
                    <!-- 상품목록에 마우스 올리면 드롭메뉴 구현 할 것 -->
                    <li class="nav-item dropdown" id="item_menu">
                        <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">상품 목록</a>
                        <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                            <li><a class="dropdown-item" href="team.php?class=1">맨체스터 시티</a></li>
                            <li><a class="dropdown-item" href="team.php?class=2">맨체스터 유나이티드</a></li>
                            <li><a class="dropdown-item" href="team.php?class=3">첼시</a></li>
                            <li><a class="dropdown-item" href="team.php?class=4">리버풀</a></li>
                            <li><a class="dropdown-item" href="team.php?class=5">토트넘</a></li>
                            <li><a class="dropdown-item" href="team.php?class=6">아스날</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart">장바구니</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">문의하기</a>
                    </li>
                    <?php   if(!$logged_in) {?>
                    <!--로그인 상태아닐 경우-->
                    <li class="nav-item">
                        <a class="nav-link" href="./login.php">로그인</a>
                    </li>
                    <?php   }   else {?>
                    <!--로그인  경우-->
                    <?php    if($_SESSION['ss_mb_id'] == "admin") {  ?>
                    <!--관리자 admin으로 로그인할 경우 관리자메뉴가 있어야한다.-->
                    <li>
                        <a class="nav-link" href="./Product/p-adminlist.php">관리자메뉴</a>
                    </li>
                    <?php   }   ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./mypage.php">마이페이지<?php echo("(".$_SESSION['ss_mb_id'].")");  ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php">로그아웃</a>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>
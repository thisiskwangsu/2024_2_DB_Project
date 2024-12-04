<?php   
    include("DB/dbconn.php");

    $logged_in = isset($_SESSION['ss_mb_id']);
    $user_name = $logged_in ? $_SESSION['ss_mb_id'] : null;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">홈쇼핑</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">홈</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products">상품 목록</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart">장바구니</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="checkout">결제</a>
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
                <li class="nav-item">
                    <a class="nav-link" href="./mypage.php">마이페이지</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./logout.php">로그아웃</a>
                </li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>
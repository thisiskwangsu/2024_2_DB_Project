<?php   
    include("DB/dbconn.php");

    $logged_in = isset($_SESSION['ss_mb_id']); //참
    /* $user_name = $logged_in ? $_SESSION['ss_mb_id'] : null; */

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
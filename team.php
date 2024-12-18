<?php   
    include("DB/dbconn.php");

    $logged_in = isset($_SESSION['ss_mb_id']); //참, 로그인 상태인지 아닌지 확인하는 불변수
        /* $user_name = $logged_in ? $_SESSION['ss_mb_id'] : null; */
        
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    $class = $_GET['class']; //드롭메뉴의 퀄이에서 클래스를 받아옴

    $sql = "SELECT * FROM product WHERE class = '$class' LIMIT 1 OFFSET 0"; //첫번째 레코드
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result); //row 두개 불러옴 away

    $sql = "SELECT * FROM product WHERE class = '$class' LIMIT 1 OFFSET 1";//두번쨰 레코드
    $result_ = mysqli_query($conn, $sql);
    $row_ = mysqli_fetch_assoc($result_); //홈


    switch ($class) {
        case 1: //맨시티
            # code...
            $teamName = "맨체스터시티";
            $uni_home = "Product/photo/mancity_home.jpg"; //사진경로
            $uni_away = "Product/photo/mancity_away.jpg";
            $query = $row['code']; //레코드 구분 어웨이
            $query_ = $row_['code'];
            break;
        case 2: //맨유
            $teamName = "맨체스터유나이티드";
            $uni_home = "Product/photo/manutd_home_7.jpg";
            $uni_away = "Product/photo/manutd_away_7.jpg";
            $query = $row['code'];
            $query_ = $row_['code'];
            break;
        case 3: //첼시
            # code...
            $teamName = "첼시";
            $uni_home = "Product/photo/chelsea_home.jpg";
            $uni_away = "Product/photo/chelsea_away.jpg";
            $query = $row['code'];
            $query_ = $row_['code'];
            break;
        case 4: //리버풀
            # code...
            $teamName = "리버풀";
            $uni_home = "Product/photo/liverpool_home.jpg";
            $uni_away = "Product/photo/liverpool_away.jpg";
            $query = $row['code'];
            $query_ = $row_['code'];
            break;
        case 5: //토트넘
            # code...
            $teamName = "토트넘";
            $uni_home = "Product/photo/tot_home.jpg";
            $uni_away = "Product/photo/tot_away.jpg";
            $query = $row['code'];
            $query_ = $row_['code'];
            break;
        case 6: //아스날
            # code...
            $teamName = "아스날";
            $uni_home = "Product/photo/arsnal_home.jpg";
            $uni_away = "Product/photo/arsnal_away.jpg";
            $query = $row['code'];
            $query_ = $row_['code'];
            break;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
                        <a class="nav-link" href="showbag.php">장바구니</a>
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1><?php   echo($teamName);    ?></h1>
            </div>
        </div>

        <div class="row mt-4 justify-content-center">
            <!-- 상품 카드 1 홈 유니폼-->
            <div class="col-md-4">
                <div class="card">
                    <img src=<?php echo($uni_home)?> class="card-img-top" alt="상품 이미지">
                    <div class="card-body">
                        <h5 class="card-title"><?php    echo($teamName);    ?> 홈 유니폼</h5>
                        <p class="card-text"></p>
                        <a href="Product/p-show.php?code=<?php echo($query_); ?>" class="btn btn-primary">자세히 보기</a>
                    </div>
                </div>
            </div>

            <!-- 상품 카드 2 어웨이 유니폼 -->
            <div class="col-md-4">
                <div class="card">
                    <img src=<?php echo($uni_away) ?> class="card-img-top" alt="상품 이미지">
                    <div class="card-body">
                        <h5 class="card-title"><?php    echo($teamName);    ?> 어웨이유니폼</h5>
                        <p class="card-text"></p>
                        <a href="Product/p-show.php?code=<?php echo($query); ?>" class="btn btn-primary">자세히 보기</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'Frame/bottom.php'; ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>

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
        <div class="row mt-4 justify-content-center">

            <?php
            include("DB/dbconn.php");

            // 검색어 처리
            $query = isset($_POST['query']) ? $_POST['query'] : ''; // 검색어

            echo ('<div class="row">
                <div class="col-md-12 text-center">
                    <h1>' . htmlspecialchars($query) . ' 검색결과</h1>
                </div>
            </div>');

    // SQL 쿼리 실행
    $sql = "SELECT * FROM product WHERE name LIKE '%" . mysqli_real_escape_string($conn, $query) . "%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
    $userfile = "Product/photo/" . $row['userfile']; // 사진
    $name = $row['name'];
    $content = isset($row['content']) ? $row['content'] : "상품 설명이 없습니다.";
    $detailPage = "product/p-show.php?code=" . $row['code']; // 상세 페이지 링크

    echo ('
    <div class="col-md-4 mb-4 d-flex justify-content-center">
        <div class="card h-100">
            <img src="' . htmlspecialchars($userfile) . '" class="card-img-top" alt="상품 이미지">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">' . htmlspecialchars($name) . '</h5>
                <p class="card-text">' . htmlspecialchars($content) . '</p>
                <a href="' . htmlspecialchars($detailPage) . '" class="btn btn-primary mt-auto">자세히 보기</a>
            </div>
        </div>
    </div>
    ');
    }
    } else {
    echo '<div class="col-md-12 text-center">
        <p>검색 결과가 없습니다.</p>
    </div>';
    }
    ?>
        </div>
    </div>

</body>

</html>
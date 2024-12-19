<?php include("../DB/dbconn.php"); 
$logged_in = isset($_SESSION['ss_mb_id']); //참, 로그인 상태인지 아닌지 확인하는 불변수
/* $user_name = $logged_in ? $_SESSION['ss_mb_id'] : null; */
$Session = $_SESSION['ss_mb_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>상품 상세 페이지</title>
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
            <a class="navbar-brand" href="../index.php">축구 유니폼 홈쇼핑</a>
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
                            <li><a class="dropdown-item" href="../team.php?class=1">맨체스터 시티</a></li>
                            <li><a class="dropdown-item" href="../team.php?class=2">맨체스터 유나이티드</a></li>
                            <li><a class="dropdown-item" href="../team.php?class=3">첼시</a></li>
                            <li><a class="dropdown-item" href="../team.php?class=4">리버풀</a></li>
                            <li><a class="dropdown-item" href="../team.php?class=5">토트넘</a></li>
                            <li><a class="dropdown-item" href="../team.php?class=6">아스날</a></li>
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
                        <a class="nav-link" href="../login.php">로그인</a>
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
                        <a class="nav-link" href="../mypage.php">마이페이지<?php echo("(".$_SESSION['ss_mb_id'].")");  ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">로그아웃</a>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </nav>
    <?php

    $code = $_GET['code']; // 상품 코드

    // 후기 저장 처리
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = "test_user"; // 실제 환경에서는 세션에서 사용자 ID를 가져옵니다.
        $comment = $_POST['comment'];

        if (!empty($comment)) {
            $sql_insert = "INSERT INTO after (user_id, comment, product_code) VALUES ('$user_id', '$comment', '$code')";
            mysqli_query($conn, $sql_insert);
        }
    }

    // 상품 정보 조회
    $sql = "SELECT * FROM product WHERE code = '$code'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $name = $row['name'];
    $content = $row['content'];
    $price1 = $row['price1'];
    $price2 = $row['price2'];
    $userfile = $row['userfile'];

    // 조회수 증가
    $hit = $row['hit'] + 1;
    mysqli_query($conn, "UPDATE product SET hit = $hit WHERE code = '$code'");

    echo ("
    <table width=650 border=0 align=center>
        <tr>
            <td width=250 align=center>
                <a href='#' onclick=\"window.open('./photo/$userfile', '_new', 'width=450, height=450')\">
                    <img src='./photo/$userfile' width=150 border=1>
                </a>
            </td>
            <td width=400 valign=top>
                <table border=0 width=100%>
                    <tr>
                        <td width=80 align=center>상품코드:</td>
                        <td width=320>&nbsp;&nbsp;$code</td>
                    </tr>
                    <tr>
                        <td align=center>상품이름:</td>
                        <td>&nbsp;&nbsp;$name</td>
                    </tr>
                    <tr>
                        <td align=center>상품가격:</td>
                        <td>&nbsp;&nbsp;<strike>$price1&nbsp;원</strike></td>
                    </tr>
                    <tr>
                        <td align=center>할인가격:</td>
                        <td>&nbsp;&nbsp;<b>$price2&nbsp;원</b></td>
                    </tr>
                     <tr>
                        <td colspan=2 height=100 valign=bottom align=center>
                            <form method=POST action=../tobag.php?code=$code>
                                <input type=text size=3 name=quantity value=1>&nbsp;
                                <input type=submit value=담기>
                            </form>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <br>

    <table width=650 border=0 align=center>
        <tr>
            <td align=center>[상품 상세 설명]</td>
        </tr>
        <tr>
            <td><hr size=1></td>
        </tr>
        <tr>
            <td>$content</td>
        </tr>
    </table>
    ");

    // 후기 출력
    echo "
    <table width=650 border=0 align=center>
        <tr>
            <td align=center>[후기 작성]</td>
        </tr>
        <tr>
            <td>
                <form method='POST' action='after_proc.php?code=$code'>
                    <input name='id' value='$Session' required></input>
                    <textarea name='comment' rows='3' cols='60' placeholder='후기를 작성하세요.' required></textarea>
                    <br>
                    평점: 
                    <select name='rating' required>
                        <option value=''>-- 선택 --</option>
                        <option value=1>1점</option>
                        <option value=2>2점</option>
                        <option value=3>3점</option>
                        <option value=4>4점</option>
                        <option value=5>5점</option>
                    </select>
                    <input type='submit' value='후기 작성'>
                </form>
            </td>
        </tr>
    </table>";

    // 후기 목록 출력
    echo "
    <table width=650 border=0 align=center>
        <tr>
            <td align=center>[후기 목록]</td>
        </tr>
        <tr>
            <td><hr size=1></td>
        </tr>";

    $sql_reviews = "SELECT * FROM after WHERE code = '$code' ORDER BY id DESC";
    $reviews_result = mysqli_query($conn, $sql_reviews);

    while ($review = mysqli_fetch_assoc($reviews_result)) {
        $review_user = $review['id'];
        $review_comment = $review['content'];
        $rating = $review['rating'];
        echo "
        <tr>
            <td>
                <b>$review_user</b>: $review_comment<br>펑점: $rating
            </td>
        </tr>
        <tr>
            <td><hr size=1></td>
        </tr>";
    }

    echo "</table>";

    mysqli_close($conn);
    ?>
    <?php include '../Frame/bottom.php'; ?>
</body>

</html>
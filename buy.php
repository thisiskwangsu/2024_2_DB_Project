<?php
include("DB/dbconn.php");

$Session = $_SESSION['ss_mb_id']; // 세션값 아이디
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>쇼핑 페이지</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- 메인 컨텐츠 -->
    <div class="container mt-5">
        <!-- 제목 -->
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>상품 구매 단계</h1>
                <p class="text-muted"><strong><?php echo $Session; ?></strong>님의 구입 예정 품목</p>
            </div>
        </div>

        <!-- 쇼핑백 테이블 -->
        <div class="row mt-4">
            <?php
            // 쇼핑백에서 특정 사용자의 구매 정보 읽기
            $sql = "SELECT * FROM shoppingbag WHERE session = '$Session'";
            $result = mysqli_query($conn, $sql);
            $total = mysqli_num_rows($result);

            if (!$total) {
                echo '<div class="col-md-12 text-center"><p class="text-danger">쇼핑백에 담긴 상품이 없습니다.</p></div>';
            } else { //쇼핑백에 담긴 물건이 있으면
                while ($row = mysqli_fetch_assoc($result)) {
                    $pcode = $row['pcode'];
                    $quantity = $row['quantity'];

                    $sql = "SELECT * FROM product WHERE code = '$pcode'";
                    $productResult = mysqli_query($conn, $sql);

                    while ($product = mysqli_fetch_assoc($productResult)) {
                        $userfile = $product['userfile'];
                        $pname = $product['name'];
                        $price = $product['price2'];
                        $subTotalPrice = $quantity * $price;
                        $subTotalPrice += $subTotalPrice;

                        echo '
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="Product/photo/' . $userfile . '" class="card-img-top" alt="' . $pname . '">
                                <div class="card-body">
                                    <h5 class="card-title">' . $pname . '</h5>
                                    <p class="card-text">
                                        가격: ' . number_format($price) . ' 원<br>
                                        수량: ' . $quantity . ' 개<br>
                                        합계: ' . number_format($subTotalPrice) . ' 원
                                    </p>
                                    <a href="product/p-show.php?code=' . $pcode . '" class="btn btn-primary">상품 자세히 보기</a>
                                </div>
                            </div>
                        </div>';
                    }
                }
            }
            ?>
        </div>

        <!-- 총 금액 -->
        <div class="row">
            <div class="col-md-12 text-end">
                <h4>총 구매 금액: <strong><?php echo number_format($subTotalPrice); ?> 원</strong></h4>
            </div>
        </div>
        <?php
            $sql = "SELECT * FROM member WHERE mb_id = '$Session'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $receiver = $row['mb_name'];
            echo($mb_name);
            $zipcode = $row['zipcode'];
            $addr1 = $row['addr1'];
            $addr2 = $row['addr2'];
        ?>
        <!-- 배송 정보 -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h2 class="text-center">배송 정보 입력</h2>
                <form method="post" action="endshopping.php" name="buy">
                    <div class="mb-3">
                        <label for="receiver" class="form-label">받는이</label>
                        <input type="text" class="form-control" id="receiver" name="receiver"
                            value="<?php echo $receiver; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">전화번호</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="zipcode" class="form-label">우편번호</label>
                        <input type="text" class="form-control" id="sample2_postcode" placeholder="우편번호" name="zipcode"
                            value="<?php echo $zipcode; ?>" readonly>
                        <button type="button" class="btn btn-secondary mt-2" onclick="sample2_execDaumPostcode()">우편번호
                            찾기</button>
                    </div>
                    <div class="mb-3">
                        <label for="addr1" class="form-label">주소</label>
                        <input type="text" class="form-control" id="sample2_address" placeholder="주소" name="addr1"
                            value="<?php echo $addr1; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="addr2" class="form-label">상세주소</label>
                        <input type="text" class="form-control" id="sample2_detailAddress" placeholder="상세주소"
                            name="addr2" value="<?php echo $addr2; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">주문 요구사항</label>
                        <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">구매 완료</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
    // Daum 주소 찾기 API 스크립트
    function sample2_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                document.getElementById('sample2_postcode').value = data.zonecode;
                document.getElementById('sample2_address').value = data.address;
                document.getElementById('sample2_detailAddress').focus();
            }
        }).open();
    }
    </script>
</body>

</html>
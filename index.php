<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>홈쇼핑 사이트</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php'; ?>

    <!-- 메인 컨텐츠 -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>인기 상품</h1>
            </div>
        </div>

        <div class="row mt-4">
            <!-- 상품 카드 1 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="상품 이미지">
                    <div class="card-body">
                        <h5 class="card-title">상품명 1</h5>
                        <p class="card-text">가격</p>
                        <a href="product-detail.html" class="btn btn-primary">자세히 보기</a>
                    </div>
                </div>
            </div>

            <!-- 상품 카드 2 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="상품 이미지">
                    <div class="card-body">
                        <h5 class="card-title">상품명 2</h5>
                        <p class="card-text">가격</p>
                        <a href="product-detail.html" class="btn btn-primary">자세히 보기</a>
                    </div>
                </div>
            </div>

            <!-- 상품 카드 3 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="상품 이미지">
                    <div class="card-body">
                        <h5 class="card-title">상품명 3</h5>
                        <p class="card-text">가격</p>
                        <a href="product-detail.html" class="btn btn-primary">자세히 보기</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
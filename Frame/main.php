<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>인기 상품</title>
</head>

<body>
    <div class="container mt-5">
        <!-- 검색창 섹션 -->
        <div class="row mb-4">
            <div class="col-md-12">
                <form action="search.php" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="query" placeholder="상품 검색..." required>
                        <button class="btn btn-primary" type="submit">검색</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- 인기 상품 섹션 -->
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>인기 상품</h1>
            </div>
        </div>
        <div class="row mt-4">
            <?php
            include("DB/dbconn.php");
            $sql = "SELECT * FROM product ORDER BY hit DESC LIMIT 3"; // 최대 3개만 가져옴
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $userfile = "./Product/photo/" . $row['userfile'];
                $name = $row['name'];
                $content = isset($row['content']) ? $row['content'] : "상품 설명이 없습니다."; // 예시 설명
                $detailPage = "product/p-show.php?code=" . $row['code']; // 상세 페이지 링크

                echo ('
                <div class="col-md-4">
                    <div class="card">
                        <img src="' . htmlspecialchars($userfile) . '" class="card-img-top" alt="상품 이미지">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($name) . '</h5>
                            <p class="card-text">' . htmlspecialchars($content) . '</p>
                            <a href="' . htmlspecialchars($detailPage) . '" class="btn btn-primary">자세히 보기</a>
                        </div>
                    </div>
                </div>
                ');
            }
            ?>
        </div>
    </div>
</body>

</html>
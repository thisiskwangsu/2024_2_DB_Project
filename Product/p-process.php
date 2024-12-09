<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

// POST 데이터 수집
$class = $_POST['class']; // 상품 분류
$code = $_POST['pcode'];  // 상품 코드
$name = $_POST['pname'];  // 상품 이름
$content = $_POST['pcontent']; // 상품 설명
$price1 = $_POST['price1']; // 정상 가격
$price2 = $_POST['price2']; // 할인가격

// 업로드된 파일 정보
$userfile = $_FILES['userfile']['name'];       // 업로드된 파일 이름
$tmpfile = $_FILES['userfile']['tmp_name'];    // 업로드된 파일 임시 경로

// 필드 검사
if (!$code) {
    echo("
        <script>
        alert('상품코드명이 없습니다. 다시 입력하세요.');
        history.go(-1);
        </script>
    ");
    exit;
}

if (!$name) {
    echo("
        <script>
        alert('상품명이 없습니다. 다시 입력하세요.');
        history.go(-1);
        </script>
    ");
    exit;
}

if (!$price1) {
    echo("
        <script>
        alert('가격이 없습니다. 다시 입력하세요.');
        history.go(-1);
        </script>
    ");
    exit;
}

// 사진 파일 확인
if (!$userfile) {
    echo("
        <script>
        alert('상품 사진을 선택해 주세요.');
        history.go(-1);
        </script>
    ");
    exit;
} else {
    $savedir = "./photo"; // 사진 저장 경로

    // photo 폴더가 없으면 생성
    if (!is_dir($savedir)) {
        mkdir($savedir, 0777, true); //권한부여
    }

    $savepath = "$savedir/$userfile";

    if (file_exists($savepath)) {
        echo("
            <script>
            alert('동일한 파일 이름이 이미 서버에 존재합니다.');
            history.go(-1);
            </script>
        ");
        exit;
    } else {
        // 파일 복사 및 임시 파일 삭제
        if (copy($tmpfile, $savepath)) {
            unlink($tmpfile); // 임시 파일 삭제
        } else {
            echo("
                <script>
                alert('파일 저장 중 오류가 발생했습니다.');
                history.go(-1);
                </script>
            ");
            exit;
        }
    }
}

// 데이터베이스 연결
include("../DB/dbconn.php");

// SQL 쿼리
$sql = "INSERT INTO product (class, code, name, content, price1, price2, userfile, hit)
        VALUES ('$class', '$code', '$name', '$content', '$price1', '$price2', '$userfile', 0)";

$result = mysqli_query($conn, $sql);

mysqli_close($conn);

if (!$result) {
    echo("
        <script>
        alert('이미 사용중인 상품 코드입니다.');
        history.go(-1);
        </script>
    ");
    exit;
} else {
    echo("
        <script>
        alert('상품 등록이 완료되었습니다.');
        history.go(-1);
        </script>
    ");
}
?>
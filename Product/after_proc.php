<?php
    include("../DB/dbconn.php");

    $logged_in = isset($_SESSION['ss_mb_id']); //참, 로그인 상태인지 아닌지 확인하는 불변수
    $code = $_GET['code'];
    if(!$logged_in) {
        echo("<script>alert('회원만 작성 가능합니다')</script>");
        echo("<script>location.replace('./p-show.php?code=$code');</script>");
        exit;
    }

    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    $code = $_GET['code']; //제품의 코드
    $mb_id = $_POST['id']; //아이디
    $comment = $_POST['comment']; //내용
    $rating = $_POST['rating']; //평점

    $sql = "INSERT INTO after 
                        SET id = '$mb_id',
                            content = '$comment',
                            code = '$code',
                            rating = '$rating'";
    
    mysqli_query($conn, $sql);
    echo ("<meta http-equiv='Refresh' content='0; url=p-show.php?code=$code'>");
    mysqli_close($conn);
    
?>
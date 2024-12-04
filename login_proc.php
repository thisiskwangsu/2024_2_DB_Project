<?php
    include("DB/dbconn.php");

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $mb_id = trim($_POST['mb_id']);
    $mb_password = trim($_POST['mb_password']); //앞뒤 공백 제거


    if(!$mb_id || !$mb_password) {
        echo("<script>alert('회원아이디나 비밀번호가 공백이면 안됩니다.');</script>");
        echo("<script>location.replace('./login.php');</script>");
        exit;
    }

    $sql = " SELECT * FROM member WHERE mb_id = $mb_id "; //아이디 존재여부 검사
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result); //레코드


    if(!$row) { //불러온 레코드 없
        echo("<script>alert('일치하는 계정이 없습니다')</script>");
        echo("<script>location.replace('./login.php');</script>");
        exit;
    } else { //있으면
        if(!password_verify($mb_password, $row['mb_password'])) { //입력한 비밀번호와 테이블의 비밀번호가 다르면
        echo("<script>alert('비밀번호가 일치하지 않습니다.')</script>");
        echo("<script>location.replace('./login.php');</script>");
        exit;
        } else { //비밀번호 비교해서 같다면
            $_SESSION['ss_mb_id'] = $row['mb_id']; //[ss_mb_id] => 1234
            echo("<script>location.replace('./index.php');</script>");
            mysqli_close($conn);
        }
    }
?>
<?php
    include("DB/dbconn.php");

    // 사용자 입력 받기
    $mb_name = $_POST['mb_name'];
    $mb_email = $_POST['mb_email'];

    $sql = "SELECT mb_id FROM member WHERE mb_name = '$mb_name' AND mb_email = '$mb_email'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        $row = mysqli_fetch_assoc($result);
        $mb_id = $row['mb_id'];
        echo($mb_id);
        echo("<script>alert('당신의 아이디는 : $mb_id 입니다.'); location.href='login.php'; </script>");
    } else {
        echo "<script>alert('일치하는 아이디를 찾을 수 없습니다.');</script>";
    }
    mysqli_close($conn);
?>
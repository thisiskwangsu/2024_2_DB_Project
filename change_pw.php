<?php
// 비밀번호 변경 처리

    $mb_id = $_POST['mb_id']; //넘어온 아이디 이름 받음, 아이디 이름있는 컬럼의 비밀번호를 변경하자
    $mb_name = $_POST['mb_name'];
    $new_password = $_POST['new_password'];

    // 비밀번호 해시 처리
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

   include('DB/dbconn.php');

    $sql = "UPDATE member SET mb_password = '$hashed_password' WHERE mb_id = '$mb_id' AND mb_name = '$mb_name'";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('비밀번호가 성공적으로 변경되었습니다.');
        location.href='login.php';
        </script>";
    } else {
        echo "비밀번호 변경에 실패했습니다.";
    }

    mysqli_close($conn);
?>
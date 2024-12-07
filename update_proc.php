<?php
    include("DB/dbconn.php");

    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    $mb_id = $_SESSION['ss_mb_id'];
    $new_mb_name = trim($_POST['mb_name']);
    $new_mb_password = trim($_POST['new_mb_password']); //평문
    $new_hashed_password = password_hash($new_mb_password, PASSWORD_DEFAULT); //암호화
    $new_mb_email = trim($_POST['mb_email']);
    $new_postalcode = trim($_POST['postal_code']);
    $new_addr1 = trim($_POST['addr']);
    $new_addr2 = trim($_POST['detail_addr']);
    $mb_modify_datetime = date('Y-m-d H:i:s');

    $sql = "UPDATE member 
            SET mb_name = '$new_mb_name',
                mb_password = '$new_hashed_password',
                mb_email = '$new_mb_email',
                zipcode = '$new_postalcode',
                addr1 = '$new_addr1',
                addr2 = '$new_addr2',
                mb_modify_datetime = '$mb_modify_datetime' 
            WHERE mb_id = $mb_id";
    $result = mysqli_query($conn, $sql);
    if($result) {
        echo("<script>alert('수정이 완료되었습니다.');</script>");
        echo("<script>location.replace('./index.php');</script>");
    }
    
    //변경될수 있는 컬럼: 이름, 비밀번호, 이메일, 주소, (업데이트한 시간)
    //회원수정할때는 아이디는 바꾸면 안되고, 비밀번호를 확인할 필요가 있음(보류). 비밀번호 변경. 마이페이지를 볼려면 비밀번호를 입력해서 맞아야 볼수있는 기능(보류)
?>
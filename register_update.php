<?php
    include("DB/dbconn.php");

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $mode = $_POST['mode'];

    if($mode != 'insert' && $mode != 'modify') {
        echo("<script>alert('mode값이 제대로 넘어오지 않음');</script>");
        echo("<script>locatio.replace('./register.php');</script>");
        exit;
    }

    switch ($mode) {
        case 'insert';
            $mb_id = trim($_POST['mb_id']);
            $title = "회원가입";
            break;
        case 'modify';
            $mb_id = trim($_SESSION['ss_mb_id']);
            $title = "회원수정";
            break;
    }

    $mb_password = trim($_POST['mb_password']); //앞뒤 공백제거
    $mb_password_re = trim($_POST['mb_password_re']);
    $mb_name = trim($_POST['mb_name']);
    $mb_email = trim($_POST['mb_email']);
    $mb_gender = trim($_POST['mb_gender']);
    $mb_ip = $_SERVER['REMOTE_ADDR'];
    $mb_datetime = date('Y-m-d H:i:s');
    $mb_modify_datetime = date('Y-m-d H:i:s');

    echo($mb_ip);

    if (!$mb_id) {
        echo("<script>alert('id를 입력해주세요');</script>");
        echo("<script>location.replace('./register.php');</script>");
        exit;
    }

    if (!$mb_password) {
        echo("<script>alert('비밀번호를 입력해주세요.');</script>");
        echo("<script>location.replace('./register.php');</script>");
        exit;
    }

    if ($mb_password != $mb_password_re) {
        echo("<script>alert('비밀번호가 다릅니다.');</script>");
        echo("<script>location.replace('./register.php');</script>");
        exit;
    }

    if(!$mb_name) {
        echo("<script>alert('이름을 입력해주세요.');</script>");
        echo("<script>location.replace('./register.php');</script>");
        exit;
    }

    if(!$mb_email) {
        echo("<script>alert('이메일을 입력해주세요.');</script>");
        echo("<script>location.replace('./register.php');</script>");
        exit;
    }
    /*
    $sql = " SELECT PASSWORD $mb_password AS pass ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $mb_password = $row['pass']; */
    $hashed_password = password_hash($mb_password, PASSWORD_DEFAULT); //암호화

    if($mode == "insert") { //회원가입의 경우
        $sql = " SELECT * FROM member WHERE mb_id = '$mb_id' ";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {
            echo("<script>alert('이미 사용중인 회원아이디입니다.');</script>");
            echo("<script>location.replace('./register.php');</script>");
            exit;
        }
        $sql = " INSERT INTO member 
                        SET mb_id = '$mb_id',
                            mb_password = '$hashed_password',
                            mb_name = '$mb_name',
                            mb_email = '$mb_email',
                            mb_gender = '$mb_gender',
                            mb_ip = '$mb_ip',
                            mb_datetime = '$mb_datetime' ";
                            
        $result = mysqli_query($conn, $sql);

    } else if($mode = "modify") {
        $sql = "UPDATE member
                SET mb_password = '$hashed_password',
                    mb_email = '$mb_email',
                    mb_modify_datetime = '$mb_modify_datetime' 
                WHERE mb_id = '$mb_id' ";
        mysqli_query($conn, $sql);
    }
    echo("<meta http-equiv = 'Refresh' content='0; url=./login.php'>");
    mysqli_close($conn);
?>
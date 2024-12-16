<?php
    include("DB/dbconn.php");

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $logged_in = isset($_SESSION['ss_mb_id']); //로그인 세션있는지
    $quantity = $_POST['quantity']; //개수
    $code = $_GET['code'];
    $Session = $_SESSION['ss_mb_id']; //세션값 아이디

    if(!$logged_in) {
        echo("<script>
            window.alert('로그인 사용자만 구매 가능합니다.')
            history.go(-1)    
        </script>");
        exit;
    }

    if($quantity < 1 || $quantity > 100) {
        echo("<script>
            window.alert('변경하고자 하는 수량이 범위를 초과합니다.');
            history.go(-1);
        </script>");
        exit;
    }

    if(!isset($quantity)){
        $quantity = 1;
    } 

    //이미 쇼핑백에 담은 물건이면 수량만 보탬
    $sql = " SELECT * FROM shoppingbag WHERE session = '$Session' and pcode = '$code' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if($row) {
        $oldnum = $row['quantity'];
    }

    if($oldnum) {
        $quantity = $oldnum + $quantity;
        $sql = " UPDATE shoppingbag SET quantity = $quantity WHERE session = $Session and pcode = '$code' ";
        mysqli_query($conn, $sql);
    } else {
        $sql = "INSERT INTO shoppingbag(id, session, pcode, quantity) VALUES('$Session', '$Session', '$code', '$quantity') ";
        mysqli_query($conn, $sql);
    }

    mysqli_close($conn);

    echo ("<meta http-equiv='Refresh' content='0; url=showbag.php'>");
    
?>
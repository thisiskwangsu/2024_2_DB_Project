<?php
    include("DB/dbconn.php");

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $receiver = $_POST['receiver'];
    $phone = $_POST['phone']; //buy.php에서 받음
    $addr1 = $_POST['addr1'];
    $addr2 = $_POST['addr2'];
    $zipcode = $_POST['zipcode'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $Session = $_SESSION['ss_mb_id'];


    if (!$receiver){
        echo("
            <script>
            window.alert('수신자 이름이 없습니다. 다시 입력하세요.')
            history.go(-1)
            </script>
        ");
        exit;
    }
    
    if(!$phone){
        echo("
            <script>
            window.alert('수신자의 전화번호가 없습니다. 다시 입력하세요.')
            history.go(-1)
            </script>
        ");
        exit;
    }
    
    if(!$addr1){
        echo("
            <script>
            window.alert('배송 주소가 없습니다. 다시 입력하세요.')
            history.go(-1)
            </script>
        ");
        exit;
    }

    $buydate = date("Y-m-d H:i:s");	// 구매 날짜 저장

    $ordernum = strtoupper(substr($Session, 0, 3)) . "-" . substr($buydate, 0, 10);

    $address = "(" . $zipcode .  ")" . "&nbsp;" . $addr1 . "&nbsp;" . $addr2;

    // 배송지 주소와 구매 번호를 테이블에 저장
    $sql = "INSERT INTO receivers(id, session, sender, receiver, phone, address, message, buydate, ordernumber, status) 
    VALUES ('$Session', '$Session', '$Session', '$receiver', '$phone', '$address', '$message', '$buydate', '$ordernum', 1)";
    $result = mysqli_query($conn, $sql);

    //전체 쇼핑백 테이블에서 구매 정보를 읽어내어 복사
    $sql = "SELECT * FROM shoppingbag WHERE session = '$Session'";
    $result_ = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result_)) { //쇼핑백 티이블
        $pcode = $row['pcode'];
        $quantity = $row['quantity'];

        $sql = "INSERT INTO orderlist(id, session, pcode, quantity) VALUES('$Session', '$Session', '$pcode', '$quantity')";
        mysqli_query($conn, $sql);
    }

    $sql = "DELETE FROM shoppingbag WHERE session = '$Session'";
    mysqli_query($conn, $sql);

    mysqli_close($conn);

    echo ("<script>
 	window.alert('구매가 정상적으로 처리되었습니다. \\n주문 번호는 $ordernum 이며 My Page에서 주문 조회가 가능합니다')
    history.go(1)
    </script>
    <meta http-equiv='Refresh' content='0; url=index.php'>
");
?>
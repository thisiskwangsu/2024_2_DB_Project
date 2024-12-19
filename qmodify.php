<?php
    include("DB/dbconn.php");

    $Session = $_SESSION['ss_mb_id'];
    $code = $_GET['pcode']; //showbag.php에서 쿼리로 get보냄
    $newnum = $_POST['newnum']; //showbag.php에서 post로 보냄

    if($newnum < 1 || $newnum > 100) {
        echo ("<script>
		window.alert('변경하고자 하는 수량이 범위를 초과합니다')
		history.go(-1)
		</script>");
        exit;
    }

    $sql = "UPDATE shoppingbag SET quantity = $newnum WHERE session = '$Session' and pcode = '$code'";
    $result = mysqli_query($conn, $sql);

    mysqli_close($conn);

    echo ("<meta http-equiv='Refresh' content='0; url=showbag.php'>");

?>
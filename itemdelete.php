<?php
    include("DB/dbconn.php");

    $Session = $_SESSION['ss_mb_id'];
    $code = $_GET['pcode'];

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $sql = "DELETE FROM shoppingbag WHERE session = '$Session' and pcode = '$code' "; //�ڵ�� manc-home �̷���
    $result = mysqli_query($conn, $sql);

    mysqli_close($conn);
    echo ("<meta http-equiv='Refresh' content='0; url=showbag.php'>");
?>
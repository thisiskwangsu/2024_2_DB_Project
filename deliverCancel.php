<?php
    include("DB/dbconn.php");
    
    $ordernumber = $_GET['ordernumber'];
    echo($ordernumber);

    $sql = "DELETE  FROM receivers WHERE ordernumber = '$ordernumber'";
    mysqli_query($conn, $sql);

    mysqli_close($conn);

    echo ("<meta http-equiv='Refresh' content='0; url=mypage.php'>");
?>
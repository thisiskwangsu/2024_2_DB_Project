<?php
    include('DB/dbconn.php');

    $mb_id = $_GET['mb_id'];
    $sql = "DELETE FROM member WHERE mb_id = '$mb_id' ";

    mysqli_query($conn, $sql);

    echo("<meta http-equiv = 'Refresh' content='0; url=./members.php'>");
?>
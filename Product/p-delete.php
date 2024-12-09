<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        include("../DB/dbconn.php");

        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $code = $_GET['code'];

        $sql = "SELECT * FROM product WHERE code = '$code' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $name = $row['name'];

        echo ("
        <table border=0 width=650 align=center>
            <tr>
                <td width=100 align=center>상품코드</td>
                <td width=550><b>$code</b></td>
            </tr>
            <tr>
                <td align=center>상품이름</td><td><b>$name</b></td>
            </tr>
            <tr>
                <td colspan=2 height=50 align=center valign=center>위 상품을 삭제하시겠습니까?</td>
            </tr> 
            <tr>
                <td colspan=2 align=center><form method=post action=p-delete_proc.php?code=$code><input type=submit value='삭제 확인'></form></td>
            </tr>
            <tr>
                <td colspan=2 align=center>[<a href=p-adminlist.php>돌아가기</a>]</td>
            </tr>
        </table>"
        );
        mysqli_close($conn);
    ?>

</body>

</html>
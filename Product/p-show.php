<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <?php
    include("../DB/dbconn.php");

    $code = $_GET['code']; //p-admin에서 보냄


    $sql = "SELECT * FROM product WHERE code = '$code'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    $name = $row['name'];
    $content = $row['content'];
    $price1 = $row['price1'];
    $price2 = $row['price2'];
    $userfile = $row['userfile'];
    // 상품의 조회수를 읽어와서 1 증가시킨 다음 업데이트 쿼리를 적용
    $hit = $row['hit'];
    $hit++;
    mysqli_query($conn, "UPDATE product SET hit = $hit WHERE code = '$code'");

    echo ("
	<table width=650 border=0 align=center>
        <tr>
            <td width=250 align=center>
                <a href=# onclick=window.open('./photo/$userfile', '_new', 'width=450, height=450')>
                    <img src=./photo/$userfile width=150 border=1>
                </a>
            </td>
            <td width=400 valign=top>
                <table border=0 width=100%>
                    <tr>
                        <td width=80 align=center>상품코드:</td>
                        <td width=320>&nbsp;&nbsp;$code</td>
                    </tr>
                    <tr>
                        <td align=center>상품이름:</td>
                        <td>&nbsp;&nbsp;$name</td>
                    </tr>
                    <tr>
                        <td align=center>상품가격:</td>
                        <td>&nbsp;&nbsp;<strike>$price1&nbsp;원</strike></td>
                    </tr>
                    <tr>
                        <td align=center>할인가격:</td>
                        <td>&nbsp;&nbsp;<b>$price2&nbsp;원</b></td>
                    </tr>
                    <tr>
                        <td colspan=2 height=100 valign=bottom align=center>
                            <form method=post action=tobag.php?code=$code>
                                <input type=text size=3 name=quantity value=1>&nbsp;
                                <input type=submit value=담기>
                            </form>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <br>

    <table width=650 border=0 align=center>
        <tr>
            <td align=center>[상품 상세 설명]</td>
        </tr>
        <tr>
            <td><hr size=1></td>
        </tr>
        <tr>
            <td>$content</td>
        </tr>
    </table>
    ");
    mysqli_close($conn);
    //회원들이 물건 선택시 선택하는 기능 , 후기 기능 추가, 댓글 기능 추가 할 것
    ?>
</body>

</html>
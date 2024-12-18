<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>상품 목록</title>
    <link href="./style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
    include('../DB/dbconn.php'); // 데이터베이스 연결
    //p-adminlist는 관리자 계정에서만 보일수 있도록 해야한다.
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $sql = "SELECT * FROM product ORDER BY name";
    $result = mysqli_query($conn, $sql);

    echo ("<table>
                <tr>
                    <td><font size='2'>상품코드</font></td>
                    <td colspan='2'><font size='2'>상품명</font></td>
                    <td><font size='2'>권장가격</font></td>
                    <td><font size='2'>판매가격</font></td>
                    <td><font size='2'>수정/삭제</font></td>
                </tr>");

    if(mysqli_num_rows($result) == 0) { // 결과가 없을 경우
        echo("<tr><td colspan='6' align='center'>아직 등록된 상품이 없습니다</td></tr>");
    } else {
        while($row = mysqli_fetch_assoc($result)) {
            $code = $row['code'];
            $name = $row['name'];
            $userfile = $row['userfile'];
            $price1 = $row['price1'];
            $price2 = $row['price2'];

            echo ("<tr>
                    <td width='100'><font size='2'>$code</font></td>
                    <td align='center' width='30'><img src='./photo/$userfile' alt='상품 이미지'></td>
                    <td width='350' align='left'><a href='p-show.php?code=$code'><font size='2'>$name</font></a></td>
                    <td align='right' width='70'><font size='2'><strike>$price1 원</strike></font></td>
                    <td align='right' width='70'><font size='2'>$price2 원</font></td>
                    <td width='70' align='center'>
                        <font size='2'>
                            <a href='p-modify.php?code=$code'>수정</a>
                            <a href='p-delete.php?code=$code'>삭제</a>
                        </font>
                    </td>
                  </tr>");
        }
    }
    
    
    echo ("</table>");
    echo(" <td><a href='p-input.php'>상품추가하러가기</a></td>");
    echo(" <td><a href='../members.php'>회원목록보기</a></td>");

    //회원목록기능추가할것

    mysqli_close($conn); // 데이터베이스 연결 종료
    ?>
</body>

</html>
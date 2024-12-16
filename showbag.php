<?php
    include("DB/dbconn.php");
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    $logged_in = isset($_SESSION['ss_mb_id']); //로그인 세션있는지

    if(!isset($logged_in)) {
        echo("<script>
            window.alert('로그인 사용자만 이용하실 수 있어요')
            history.go(-1)
            </script>");
        exit;
    }

    $Session = $_SESSION['ss_mb_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <table width=690 border=0>
        <tr>
            <td align=center>
                <font size=3><b>쇼핑 카트</b>
            </td>
        </tr>
        <tr>
            <td align=right>
                <font size=2><b>
                        <?php echo($Session); ?>
                    </b>님의 현재 쇼핑 카트 내용
            </td>
    </table>
    <!-- 전체 쇼핑백 테이블에서 특정 사용자의 구매 정보만을 빼낸다. -->
    <?php
        $sql = "SELECT * FROM shoppingbag WHERE session = '$Session' ";
        $result = mysqli_query($conn, $sql);
        
        echo ("
        <table border=1 width=690>
            <tr>
                <td width=100 align=center><font size=2>상품사진</td>
                <td width=300 align=center><font size=2>상품이름</td>
                <td width=90 align=center><font size=2>가격(단가)</td>
                <td width=50 align=center><font size=2>수량</td>
                <td width=100 align=center><font size=2>품목별합계</td>
                <td width=50 align=center><font size=2>삭제</td>
            </tr>
");

        if(!$result) {
            echo("<tr>
                    <td colspan=6 align=center><font size=2>쇼핑백에 담긴 상품이 없습니다.</td>
                </tr>
        </table>");
        } else {
            $totalPrice = 0;
            while($row = mysqli_fetch_assoc($result)/*쇼핑백 테이블에서 */) {
                $pcode = $row['pcode']; //상품코드
                $quantity = $row['quantity']; //개수

                $sql = "SELECT * FROM product WHERE code = '$pcode'"; 
                $result_ = mysqli_query($conn, $sql);

                while($row_ = mysqli_fetch_assoc($result_)){//제품테이블
                    $userfile = $row_['userfile'];
                    $name = $row_['name'];

                    $price = $row_['price2'];

                    $subTotalPrice = $quantity * $price;
                    $totalPrice = $totalPrice + $subTotalPrice;

                    echo("<tr>
                            <td align=center>
                                <a href=# onclick=\"window.open('Product/photo/$userfile', '_new', 'width=450,   height=450')\"><img src='Product/photo/$userfile' width=50   border=0></a>
                            </td>
                            <td align=left><font size=2>
                                <a   href=p-show.php?code=$pcode>$name </a>
                            </td>
                            <td align=right>
                                <font size=2>$price&nbsp;원
                            </td>
                            <td align=center>
                                <form method=post action=qmodify.php?pcode=$pcode>
                                <input type=text name=newnum size=3 value=$quantity>&nbsp;<input type=submit value=변경>
                            </td>
                                </form>
                            <td align=right><font size=2>
                            $subTotalPrice&nbsp;원
                            </td>
                            <td align=center>
                                <form method=post action=itemdelete.php?pcode=$pcode><input type=submit value=삭제>
                            </td>
                                </form>
                        </tr>"
                        );
                }   
            }
            echo("<tr>
                        <td colspan=6 align=right><font size=2>총 구매 금액: $totalPrice 원</td>
                    </tr>
            </table>");
        }
        mysqli_close($conn);
        
        echo ("<table width=690 border=0>
                    <tr>
                        <td align=center><font size=2>[<a href=buy.php>구매결정</a>] &nbsp; [<a href=index.php>쇼핑계속</a>]</td>
                    </tr>
                </table>");
    ?>
</body>

</html>
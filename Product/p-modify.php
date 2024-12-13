<?php   include("../DB/dbconn.php");    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        $code = $_GET['code'];
        $sql = "SELECT * FROM product WHERE code = '$code'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $class = $row['class'];
        $name = $row['name'];
        $price1 = $row['price1'];
        $price2 = $row['price2'];
        $content = $row['content'];
        $userfile = $row['userfile'];

        echo ("
        <table align=center border=0 width=650>     
            <form method=post action=p-modify_proc.php?code=$code enctype='multipart/form-data'>
                <tr>
                    <td width=100 align=center>상품코드</td>
                    <td width=550><b>$code</b></td>
                </tr>
                <tr>
                    <td align=center>상품분류</td>
                    <td><select name=class>");

        switch($class) {
            case 1:
                echo ("<option value=1 selected>mancity</option>
			    <option value=2>manutd</option>
                <option value=3>chelsea</option>
                <option value=4>liverpool</option>
                <option value=5>tottenham</option>
                <option value=6>arsnal</option>");
		        break;
            case 2:
                echo ("<option value=1>mancity</option>
			    <option value=2 selected>manutd</option>
                <option value=3>chelsea</option>
                <option value=4>liverpool</option>
                <option value=5>tottenham</option>
                <option value=6>arsnal</option>");
                break;
            case 3:
                echo ("<option value=1>mancity</option>
			    <option value=2>manutd</option>
                <option value=3 selected>chelsea</option>
                <option value=4>liverpool</option>
                <option value=5>tottenham</option>
                <option value=6>arsnal</option>");
                break;
            case 4:
                echo ("<option value=1>mancity</option>
			    <option value=2>manutd</option>
                <option value=3>chelsea</option>
                <option value=4 selected>liverpool</option>
                <option value=5>tottenham</option>
                <option value=6>arsnal</option>");
                break;
            case 5:
                echo ("<option value=1 selected>mancity</option>
			    <option value=2>manutd</option>
                <option value=3>chelsea</option>
                <option value=4>liverpool</option>
                <option value=5 selected></option>
                <option value=6>arsnal</option>");
                break;
            case 6:
                echo ("<option value=1>mancity</option>
			    <option value=2>manutd</option>
                <option value=3>chelsea</option>
                <option value=4>liverpool</option>
                <option value=5>tottenham</option>
                <option value=6 selected>arsnal</option>");
                break;
        }

        echo ("         </select>
                    </td>
                </tr>
                <tr>
                    <td align=center>상품이름</td><td><input type=text name=name size=70 value='$name'></td>
                </tr>
                <tr>
                    <td align=center>상품설명</td><td><textarea name=content rows=15 cols=75>$content</textarea></td>
                </tr>
                <tr>
                    <td align=center>정상가격</td><td><input type=text name=price1 size=15 value=$price1>원</td>
                </tr>
                <tr>
                    <td align=center>할인가격</td><td><input type=text name=price2 size=15 value=$price2>원</td>
                </tr>
                <tr>
                    <td align=center>상품사진</td><td><input type=file size=30 name=userfile><-- $userfile</td>
                </tr>
                <tr>
                    <td align=center colspan=2><input type=submit value=수정완료>
                </tr>
	        </form>
	    </table>");
    ?>
</body>

</html>
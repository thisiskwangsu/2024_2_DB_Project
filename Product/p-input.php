<!DOCTYPE html>
<html lang="en">
<!-- 상품을 올리는 기능, 테이블에도 올라가고, 페이지에도 올라감. -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>상품등록</title>
    <link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <table>
        <form method=POST action="./p-process.php" enctype='multipart/form-data'>
            <tr>
                <th>상품분류</th>
                <td>
                    <select name=class>
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <!-- value는 물품 카테고리? -->
                    </select>
                </td>
            </tr>
            <tr>
                <th>상품코드</th>
                <td><input type=text name=pcode size=20></td>
            </tr>
            <tr>
                <th>상품이름</th>
                <td><input type=text name=pname size=70></td>
            </tr>
            <tr>
                <th>상품설명</th>
                <td><textarea name=pcontent rows=15 cols=75></textarea></td>
            </tr>
            <tr>
                <th>정상가격</th>
                <td><input type=text name=price1 size=15>원</td>
            </tr>
            <tr>
                <th>할인가격</th>
                <td><input type=text name=price2 size=15>원</td>
            </tr>
            <tr>
                <th>상품사진</th>
                <td><input type=file size=30 name=userfile></td>
            </tr>
            <tr>
                <th>
                    <input type=submit value=등록하기>
                </th>
            </tr>
        </form>
    </table>

</body>

</html>
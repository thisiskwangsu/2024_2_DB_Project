<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        if(isset($_SESSION['ss_mb_id'])) {
            echo("<script>alert('이미 로그인 했습니다.');</script>");
            echo("<script>location.replace('./index.php');</script>");
        } else { ?>
    <!--세션 없으면-->
    <h1>로그인</h1>
    <form action="./login_proc.php" method="POST">
        <table>
            <tr>
                <th>아이디</th>
                <td><input type="text" name="mb_id"></td>
            </tr>
            <tr>
                <th>비밀번호</th>
                <td><input type="password" name="mb_password"></td>
            </tr>
            <tr>
                <td colspan="2" class="td_center">
                    <input type="submit" value="로그인">
                    <a href="./register.php">회원가입</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="./findid.html">아이디찾기</a>
                </td>
                <td>
                    <a href="./changepw.php">비밀번호찾기</a>
                </td>
            </tr>

        </table>
    </form>
    <?php   }   ?>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <h1>비밀번호 찾기</h1>
    <form method="POST">
        <table>
            <tr>
                <th>아이디</th>
                <td><input type="text" name="mb_id"></td>
            </tr>

            <tr>
                <th>이름</th>
                <td><input type="text" name="mb_name"></td>
            </tr>
            <tr>
                <td colspan="2" class="td_center">
                    <input type="submit" value="확인">
                </td>
            </tr>
        </table>
    </form>
    <?php
    //여기서 아이디와 이름 맞으면 비밀번호를 바꿀수 있는 alert창을 만든다.
         if($_SERVER["REQUEST_METHOD"] == "POST") {
            $mb_id = $_POST['mb_id'];
            $mb_name = $_POST['mb_name'];

            include("DB/dbconn.php");

            $sql = "SELECT * FROM member WHERE mb_id = '$mb_id' AND mb_name = '$mb_name'";
            $result = mysqli_query($conn, $sql);

            if($row = mysqli_fetch_assoc($result)) {
                echo("<script>alert('비밀번호를 변경할 수 있습니다.');</script>");
                echo("<form method='post' action='change_pw.php'>
                        <input type='hidden' name='mb_id' value='$mb_id'>
                        <input type='hidden' name='mb_name' value='$mb_name'>
                        새로운 비밀번호: <input type='password' name='new_password' required><br>
                        <input type='submit' value='비밀번호 변경'>
                    </form>");
            } else {
                echo "<script>alert('아이디와 이름이 일치하지 않습니다.');</script>";
            }
        }
        mysqli_close($conn);
    ?>


</body>

</html>
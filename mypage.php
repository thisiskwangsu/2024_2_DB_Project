<?php
    include("DB/dbconn.php");

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $id = $_SESSION['ss_mb_id']; //로그인 성공했을떄 세션값
    $sql = " SELECT * FROM member WHERE mb_id = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $mb_id = $row['mb_id'];
    $mb_name = $row['mb_name'];
    $mb_gender = $row['mb_gender'];
    $mb_email = $row['mb_email'];
    $mb_id = $row['mb_id'];
    $zipcode = $row['zipcode'];
    $addr1 = $row['addr1'];
    $addr2 = $row['addr2'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPage</title>
    <link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <table>
        <tr>
            <th>아이디</th>
            <td><?php    echo($mb_id);   ?></td>
        </tr>
        <tr>
            <th>이름</th>
            <td><?php   echo($mb_name);    ?></td>
        </tr>
        <tr>
            <th>성별</th>
            <td><?php   echo($mb_gender);   ?></td>
        </tr>
        <tr>
            <th>이메일</th>
            <td><?php   echo($mb_email);   ?></td>
        </tr>
        <tr>
            <th>우편번호</th>
            <td><?php   echo($zipcode);   ?></td>
        </tr>
        <tr>
            <th>주소</th>
            <td><?php   echo($addr1);   ?></td>
        </tr>
        <tr>
            <th>상세주소</th>
            <td><?php   echo($addr2);   ?></td>
        </tr>
        <tr>
            <td colspan="2" class="td_center">
                <button type="submit"><a href="./update.php">수정하기</a><button>
                        <a onclick="history.back()">돌아가기</a>
            </td>
        </tr>
    </table>
</body>

</html>
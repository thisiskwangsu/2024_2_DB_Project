<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
    //관리자에서 멤버들 명단 보여주는 곳
    include("DB/dbconn.php");

    $sql = "SELECT * FROM member";
    $result = mysqli_query($conn, $sql);

    echo ("<table>
                <tr>
                    <td><font size='2'>이름</font></td>
                    <td><font size='2'>아이디</font></td>
                    <td><font size='2'>회원가입접속ip</font></td>
                    <td><font size='2'>이메일</font></td>
                    <td><font size='2'>우편번호</font></td>
                    <td><font size='2'>주소</font></td>
                    <td><font size='2'>등록일</font></td>
                    <td><font size='2'>탈퇴</font></td>
                </tr>");
    
    if(!mysqli_num_rows($result)) {
        echo("<tr><td colspan='6' align='center'>회원이 없습니다.</td></tr>");
    } else {
        while($row = mysqli_fetch_assoc($result)) {
            $mb_name = $row['mb_name']; //이름
            $mb_id = $row['mb_id']; //아이디
            $mb_ip = $row['mb_ip']; //아이피
            $zipcode = $row['zipcode']; //우편번호
            $addr = $row['addr1']; //주소
            $date = $row['mb_datetime']; //등록일
            $mb_email = $row['mb_email'];
            
            echo ("<tr>
                    <td width='100'><font size='2'>$mb_name</font></td>
                    <td width='100'><font size='2'>$mb_id</font></td>
                    <td width='100'><font size='2'>$mb_ip</font></td>
                    <td width='100'><font size='2'>$mb_email</font></td>
                    <td width='100'><font size='2'>$zipcode</font></td>
                    <td width='100'><font size='2'>$addr</font></td>
                    <td width='100'><font size='2'>$date</font></td>
                    <td width='70' align='center'>
                        <font size='2'>
                            <a href='memberout.php?mb_id=$mb_id'>탈퇴</a>
                        </font>
                    </td>
                  </tr>");
        }
    }
?>
</body>

</html>
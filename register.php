<?php
    include("DB/dbconn.php");

    if(isset($_SESSION['ss_mb_id']) && $_GET['mode'] == 'modify') {
        $mb_id = $_SESSION['ss_mb_id'];

        $sql = " SELECT * FROM member WHERE mb_id = '$mb_id' ";
        $result = mysqli_query($conn, $sql);
        $mb = mysqli_fetch_assoc($result);
        mysqli_close($conn);

        $mode = "modify";
        $title = "회원수정";
        $modify_mb_info = "randonly";
    } else {
        $mode = "insert";
        $title = "회원가입";
        $modify_mb_info = "";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        if(isset($_SESSION['ss_mb_id'])) { //ss_mb_id 확인하여 로그인된 사용자라면 로그인 되었다는 알람과 index로 이동
            echo("<script>alert('이미 로그인 했습니다.');</script>");
            echo("<script>location.replace('./index.php');</script>");
        } else { ?>
    <form action="./register_update.php" onsubmit="return fregisterform_submit(this);" method="POST">
        <input type="hidden" name="mode" value="<?php echo $mode ?>">

        <table>
            <tr>
                <th>아이디</th>
                <td><input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" <?php echo $modify_mb_info ?>>
                </td>
            </tr>
            <tr>
                <th>비밀번호</th>
                <td><input type="password" name="mb_password"></td>
            </tr>
            <tr>
                <th>비밀번호 확인</th>
                <td><input type="password" name="mb_password_re"></td>
            </tr>
            <tr>
                <th>이름</th>
                <td><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>"
                        <?php echo $modify_mb_info ?>></td>
            </tr>
            <tr>
                <th>이메일</th>
                <td><input type="text" name="mb_email" value="<?php echo $mb['mb_email']?>"></td>
            </tr>
            <tr>
                <th>성별</th>
                <td>
                    <label><input type="radio" name="mb_gender" value="남자"
                            <?php echo($mb['mb_gender'] == "남자") ? "checked" : ""; ?>>남자</label>
                    <label><input type="radio" name="mb_gender" value="여자"
                            <?php echo($mb['mb_gender'] == "남자") ? "checked" : ""; ?>>여자</label>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="td_center"><input type="submit" value="<?php echo $title?>"><a
                        href="./login.php">취소</a></td>
            </tr>
        </table>
    </form>
    <?php } ?>

    <script>
    function fregisterform_submit(f) { //submit 최종 폼체크
        if (f.mb_id.value.length < 1) {
            alert("아이디를 입력하십시오.");
            f.mb_id.focus();
            return false;
        }

        if (f.mb_name.value.length < 1) {
            alert("이름을 입력하시오");
            f.mb_name.focus();
            return false;
        }

        if (f.mb_password.value.length < 3) {
            alert("비밀번호를 3글자 이상 입력하십시오: ");
            f.mb_password.focus();
            return false;
        }

        if (f.mb_password.value != f.mb_password_re.value) {
            alert("비밀번호가 같지않습니다");
            f.mb_password_re.focus();
            return false;
        }

        if (f.mb_password.value.length > 0) {
            if (f.mb_password_re.value.length < 3) {
                alert("비밀번호 3글자 이상 입력하십시오");
                f.mb_password_re.focus();
                return false;
            }
        }

        if (f.mb_email.value.length < 1) {
            alert("이메일을 입력하시오");
            f.mb_email.focus();
            return false;
        }

        if (f.mb_email.value.length > 0) { //이메일 형식 검사
            var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; //이메일 정규표현식
            if (f.mb_email.value.match(regex) == null) {
                alert("이메일 주소가 형식에 맞지않습니다.");
                f.mb_email.focus();
                return false;
            }
        }
        return true;
    }
    </script>
</body>

</html>
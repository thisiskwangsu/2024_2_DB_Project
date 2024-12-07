<?php
    include("DB/dbconn.php");

    /* if(isset($_SESSION['ss_mb_id']) && $_GET['mode'] == 'modify') {
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
    } */
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
                <th>주소</th>
                <td>
                    <input type="text" size=5 id="sample2_postcode" placeholder="우편번호" readonly name="postal_code">
                    <input type="button" onclick="sample2_execDaumPostcode()" value="우편번호 찾기"><br>
                    <input type="text" size=45 id="sample2_address" placeholder="주소" readonly name="addr"><br>
                    <input type="text" size=20 id="sample2_detailAddress" placeholder="상세주소" name="detail_addr">
                    <input type="text" id="sample2_extraAddress" placeholder="참고항목" readonly>

                    <!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
                    <div id="layer"
                        style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
                        <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer"
                            style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1"
                            onclick="closeDaumPostcode()" alt="닫기 버튼">
                    </div>

                    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
                    <script>
                    // 우편번호 찾기 화면을 넣을 element
                    var element_layer = document.getElementById('layer');

                    function closeDaumPostcode() {
                        // iframe을 넣은 element를 안보이게 한다.
                        element_layer.style.display = 'none';
                    }

                    function sample2_execDaumPostcode() {
                        new daum.Postcode({
                            oncomplete: function(data) {
                                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                                var addr = ''; // 주소 변수
                                var extraAddr = ''; // 참고항목 변수

                                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                                    addr = data.roadAddress;
                                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                                    addr = data.jibunAddress;
                                }

                                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                                if (data.userSelectedType === 'R') {
                                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                                    if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                                        extraAddr += data.bname;
                                    }
                                    // 건물명이 있고, 공동주택일 경우 추가한다.
                                    if (data.buildingName !== '' && data.apartment === 'Y') {
                                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data
                                            .buildingName);
                                    }
                                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                                    if (extraAddr !== '') {
                                        extraAddr = ' (' + extraAddr + ')';
                                    }
                                    // 조합된 참고항목을 해당 필드에 넣는다.
                                    document.getElementById("sample2_extraAddress").value = extraAddr;

                                } else {
                                    document.getElementById("sample2_extraAddress").value = '';
                                }

                                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                                document.getElementById('sample2_postcode').value = data.zonecode;
                                document.getElementById("sample2_address").value = addr;
                                // 커서를 상세주소 필드로 이동한다.
                                document.getElementById("sample2_detailAddress").focus();

                                // iframe을 넣은 element를 안보이게 한다.
                                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                                element_layer.style.display = 'none';
                            },
                            width: '100%',
                            height: '100%',
                            maxSuggestItems: 5
                        }).embed(element_layer);

                        // iframe을 넣은 element를 보이게 한다.
                        element_layer.style.display = 'block';

                        // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
                        initLayerPosition();
                    }

                    // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
                    // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
                    // 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
                    function initLayerPosition() {
                        var width = 300; //우편번호서비스가 들어갈 element의 width
                        var height = 400; //우편번호서비스가 들어갈 element의 height
                        var borderWidth = 5; //샘플에서 사용하는 border의 두께

                        // 위에서 선언한 값들을 실제 element에 넣는다.
                        element_layer.style.width = width + 'px';
                        element_layer.style.height = height + 'px';
                        element_layer.style.border = borderWidth + 'px solid';
                        // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
                        element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) -
                            width) / 2 - borderWidth) + 'px';
                        element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) -
                            height) / 2 - borderWidth) + 'px';
                    }
                    </script>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="td_center"><input type="submit" value="회원가입"><a href="./login.php">취소</a></td>
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

        if (f.mb_name.value.leng th < 1) {
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

        if (f.postal_code.value.length < 1) {
            alert('주소를 입력하세요');
            f.postal_code.focus();
            return false;
        }

        if (f.detail_code.value.length < 1) {
            alert('상세주소를 입력하세요');
            f.detail_code.focus();
            return false;
        }
        return true;
    }
    </script>
</body>

</html>
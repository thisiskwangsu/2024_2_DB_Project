<?php
    include("DB/dbconn.php");
    
    $Session = $_SESSION['ss_mb_id']; //세션값 아이디
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
                <font size=3><b>상품 구매 단계</b>
            </td>
        </tr>
        <tr>
            <td align=right>
                <font size=2><b>
                        <?php echo($Session); ?>
                    </b>님의 구입 예정 품목
            </td>
    </table>
    <?php
    //전체 쇼핑백테이블에서 특정 사용자의 구매 정보만을 읽어낸다.
        $sql = "SELECT * FROM shoppingbag WHERE session = '$Session'";
        $result = mysqli_query($conn, $sql);
        $total = mysqli_num_rows($result);
        echo ("
	<table border=1 width=690>
        <tr>
            <td width=100 align=center><font size=2>상품사진</td>
            <td width=300 align=center><font size=2>상품이름</td>
            <td width=90 align=center><font size=2>가격(단가)</td>
            <td width=50 align=center><font ssize=2>수량</td>
            <td width=100 align=center><font size=2>품목별합계</td>
        </tr>
	");

    if(!$total) {
        echo("<tr>
                <td colspan=5 align=center><font   size=2><b>쇼핑백에 담긴 상품이   없습니다.</b>
                </font>
            </td>
        </tr>
    </table>");
    } else { //담긴것이 있으면
        while($row = mysqli_fetch_assoc($result)) { //고객의 쇼핑백테이블 레코드
            $pcode = $row['pcode']; //레코드에서 상품코드
            echo($pcode);
            $quantity = $row['quantity']; //개수

            $sql = "SELECT * FROM product WHERE code = '$pcode'";
            $result_ = mysqli_query($conn, $sql);

            while($row_ = mysqli_fetch_assoc($result_)) { //제품테이블
                $userfile = $row_['userfile'];
                echo($userfile);
                $pname = $row_['name'];
                $price = $row_['price2'];

                $subTotalPrice = $quantity * $price;
                $totalPrice = $totalPrice + $subTotalPrice;

                echo("<tr>
                        <td align=center><a href=#   onclick=\"window.open('Product/photo/$userfile', '_new', 'width=450, height=450')\"><img src='Product/photo/$userfile' width=50 border=0></a></td>
			            <td align=left><font size=2><a href=product/p-show.php?code=$pcode>$pname</a></td>
			            <td align=right><font size=2>$price&nbsp;원</td>
			            <td align=center><font size=2>$quantity&nbsp;개</td>
			            <td align=right><font size=2>$subTotalPrice&nbsp;원</td>
                    </tr>");
            }
        }
        echo("<tr>
                <td colspan=5 align=right><font size=2>총 구매 금액: $totalPrice 원</td>
                </tr>
        </table>");
    }
    ?>
    <br>
    <table border=0 width=690>
        <tr>
            <td align=center>
                <font size=2>입금 계좌: <b>농협은행 (예금주: 홍길동)</b><br><br>
                    * 구입하신 물품은 입금 확인후 배송되며, 주문 진행 상황은 My Page에서 확인하실 수 있습니다.<br>
                    * 물품 배송 이전에 주문 취소를 원하시면 My Page에서 직접 주문 취소 요청을 하시면 됩니다.<br>
                    * 물품을 배송 받으신 후에 구매 취소를 원하시면 고객센터(전화:)로 연락주세요.
            </td>
        </tr>
    </table>

    <?php
        $sql = "SELECT * FROM member WHERE mb_id = $Session";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $receiver = $row['mb_name']; //받는이
        $addr1 = $row['addr1'];
        $zipcode = $row['zipcode'];
        $addr2 = $row['addr2'];

        mysqli_close($conn);
    ?>

    <br><br>
    <table width=690 border=0>
        <tr>
            <td align=center>
                <font size=3><b>배송정보 입력</b>
            </td>
        </tr>
    </table>

    <table width=690 border=0>
        <form method=post action=endshopping.php name=buy>
            <tr>
                <td align=right>
                    <font size=2>받는이
                </td>
                <td><input type=text name=receiver size=10 value=<?php  echo($receiver); ?>></td>
            </tr>
            <tr>
                <td align=right>
                    <font size=2>전화번호
                </td>
                <td><input type=text name=phone size=20></td>
            </tr>
            <tr>
                <td height=30 align=right>
                    <font size=2>배송주소
                </td>
                <td>
                    <input type="text" size=5 id="sample2_postcode" placeholder="우편번호" readonly name="zipcode"
                        value="<?php echo($zipcode); ?>">
                    <input type="button" onclick="sample2_execDaumPostcode()" value="우편번호 찾기"><br>
                    <input type="text" size=45 id="sample2_address" placeholder="주소" readonly name="addr1"
                        value="<?php echo htmlspecialchars($addr1); ?>"><br>
                    <input type="text" size=20 id="sample2_detailAddress" placeholder="상세주소" name="addr2"
                        value="<?php echo htmlspecialchars($addr2); ?>">
                    <input type="text" id="sample2_extraAddress" placeholder="참고항목" readonly>

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

            <tr>
                <td align=right>
                    <font size=2>주문요구사항
                </td>
                <td><textarea name=message rows=3 cols=65></textarea></td>
            </tr>
            <tr>
                <td align=center colspan=2>
                    <input type=submit value=구매완료>
                </td>
            </tr>
    </table>
    </form>
    </center>
</body>

</html>
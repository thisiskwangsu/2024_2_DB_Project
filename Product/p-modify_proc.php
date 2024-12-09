<?php
    $name = $_POST['name'];
    $price1 = $_POST['price1'];
    $price2 = $_POST['price2'];
    $content = $_POST['content'];
    $class = $_POST['class'];
    $code = $_GET['code'];
    echo($content);
    if(!$name) {
        echo("
		<script>
		window.alert('상품명이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
    }

    if(!$price1) {
        echo("
		<script>
		window.alert('가격이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
    }

    include ("../DB/dbconn.php");

    //기존상품이미지 그래도 사용할 경우
    if(!$userfile) {
        $sql = "UPDATE product SET class = '$class', name = '$name', content = '$content', price1 = '$price1', price2 = '$price2' WHERE code = '$code'";
        $result = mysqli_query($conn, $sql);
    } else { //이미지 변경시
        //기존 이미지 삭제
        $sql = "SELECT userfile FROM product WHERE code = '$code'";
        $tmp = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($tmp);
        $fname = $row['userfile'];
        $savedir = "./photo";
        unlink("./$savedir/$fname");
        //새롭게 첨부한 이미지 파일 저장하자
        $temp = $userfile;
        if(file_exists("$savedir/$temp")) {
            echo (" 
             <script>
             window.alert('동일한 파일 이름이 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
        } else {
            copy($userfile, "$savedir/$temp"); //
            unlink($userfile);
        }
        $sql = "UPDATE product SET class = '$class', name = '$name', content = '$content', price1 = '$price1', price2 = '$price2', userfile = '$userfile', WHERE code = '$code' ";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo("
              <script>
              window.alert('상품 수정에 실패했습니다')
              </script>
            ");
            exit;
        } else {
            echo("
              <script>
              window.alert('상품 수정이 완료되었습니다')
              </script>
           ");
        }
        mysqli_close($conn);
        echo ("<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>");
    }
?>
<?php
    include("../DB/dbconn.php");

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $code = $_GET['code'];
    //상품 이미지 파일을 photo 폴더 내에서 삭제
    $sql = "SELECT userfile FROM product WHERE code = '$code'";
    $tmp = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($tmp);
    $fname = $row['userfile'];
    $savedir = "./photo";
    unlink("./$savedir/$fname"); // photo/제품 삭제

    $sql = "DELETE FROM product WHERE code = '$code'";
    $result = mysqli_query($conn, $sql);

    if(!$result) {
        echo("
      <script>
      window.alert('상품 삭제에 실패했습니다')
      history.go(-1)
      </script>
   ");
   exit;
    } else {
        echo("
      <script>
      window.alert('상품이 정상적으로 삭제되었습니다')
      </script>
   ");
    }
    mysqli_close($conn);

    echo ("<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>");
?>
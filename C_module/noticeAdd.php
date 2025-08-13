<?php
require_once "db.php";
require_once "lib.php";


$idx = $_GET["idx"];

$notice = DB::fetch("select * from notice where idx = '$idx'");
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/item.css">
</head>

<body>
  <div class="reg" style="display: flex; height: 100vh !important;">

    <form action="./notice/noticeAdd.php" method="Post" enctype="multipart/form-data">


      <div id="df">
        <h1>추가</h1>
      </div>




      <div>
        <label for="title">유형</label>
        <input type="text" name="title"  id="title" required>
      </div>



      <div>
        <label for="des">내용</label>

        <input type="text" name="des"  id="des" required>
      </div>

      <div>
        <label for="price">가격</label>
        <input type="date" name="price"  id="price" required>
      </div>


      <div>
        <input type="submit" value="수정" required>
      </div>
    </form>



  </div>
  <script src="./js/file.js"></script>
</body>

</html>
<?php


require_once "db.php";

$idx = $_GET["idx"];

$item = DB::fetch("select * from item where idx = '$idx'")
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
  <div class="reg" style="display: flex; height: 100%;">

    <form action="additemAction.php" method="Post" enctype="multipart/form-data">

      <input type="hidden" name="type" value="reg" required>

      <div id="df">
        <h1>수정</h1>
      </div>

      <input type="hidden" name="idx" value="" required>

      <div>
        <img src="./images/noImg.png" alt="img" title="img">

        <input type="file" name="file" id="file" required>

      </div>

      <div>
        <label for="title">제목</label>

        <input type="text" name="title" id="title" required>
      </div>

      <div>
        <label for="cate">카테고리</label>

        <select name="cate" id="cate">
          <?php $cate = DB::fetchAll("SELECT DISTINCT cate FROM item");

          foreach ($cate as $key => $value) {


          ?>
            <option value="<?= $value->cate ?>"><?= $value->cate ?></option>
          <?php } ?>
        </select>

      </div>

      <div>
        <label for="des">내용</label>

        <input type="text" name="des" value="" id="des" required>
      </div>

      <div>
        <label for="price">가격</label>
        <input type="text" name="price" value="" id="price" required>
      </div>

    
      <div>
        <input type="submit" value="수정" required>
      </div>
    </form>



  </div>
  <script src="./js/file.js"></script>
</body>

</html>
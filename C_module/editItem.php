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
  <div class="reg" style="display: flex;overflow-Y: scroll; height: 100%;">

    <form action="itemAction.php" method="Post" enctype="multipart/form-data">

      <input type="hidden" name="type" value="reg" req>

      <div id="df">
        <h1>수정</h1>
      </div>

      <input type="hidden" name="idx" value="<?= $item->idx ?>" req>

      <div>
        <img src="<?= $item->img ?>" alt="img" title="img">

        <input type="file" name="file" id="file" req>

      </div>

      <div>
        <label for="title">제목</label>

        <input type="text" name="title" id="title" value="<?= $item->title ?>" required req>
      </div>

      <div>
        <label for="cate">카테고리</label>

        <select name="cate" id="cate">
          <?php $cate = DB::fetchAll("SELECT DISTINCT cate FROM item");

          foreach ($cate as $key => $value) {


          ?>
            <option value="<?= $value->cate ?>" <?= $value->cate === $item->cate ? "selected" : "" ?>><?= $value->cate ?></option>
          <?php } ?>
        </select>

      </div>

      <div>
        <label for="des">내용</label>

        <input type="text" name="des" value="<?= $item->des ?>" id="des" required req>
      </div>

      <div>
        <label for="price">가격</label>
        <input type="text" name="price" value="<?= $item->dis ?>" id="price" required req>
      </div>
      <?php
      $is = DB::fetch("select price from item where cate = (select DISTINCT cate from item where idx = $idx) and price != '0'")->price ?? false;
      $itemFamous = DB::fetch("select * from item where idx = '$idx'");

      ?>


      <?php
      if (!$is) {

      ?>
        <div style="display: flex;">
          <label for="famous">인기상품</label>
          <input type="checkbox" id="famous">
        </div>

        <div class="isFamous">
          <div>
            <label for="1">만원할인</label>
            <input type="radio" name="discount" value="1" <?= $itemFamous->price == "1" ? "checked" : "" ?> id="1">
          </div>
          <div>
            <label for="2">10% 할인</label>
            <input type="radio" name="discount" value="2" <?= $itemFamous->price == "2" ? "checked" : "" ?> id="2">
          </div>
          <div>
            <label for="3">30% 할인</label>
            <input type="radio" name="discount" value="3" <?= $itemFamous->price == "3" ? "checked" : "" ?> id="3">
          </div>
        <?php
      } else {

        ?>

          <div style="display: <?= $itemFamous->price == "0" ? "none" : "flex" ?>;">
            <label for="famous">인기상품</label>
            <input type="checkbox" <?= $itemFamous->price != "0" ? "checked" : "" ?> id="famous">
          </div>
          <div class="isFamous" style="display: <?= $itemFamous->price == "0" ? "none" : "flex" ?>;">
            <div>
              <label for="1">만원할인</label>
              <input type="radio" name="discount" value="1" <?= $itemFamous->price == "1" ? "checked" : "" ?> id="1">
            </div>
            <div>
              <label for="2">10% 할인</label>
              <input type="radio" name="discount" value="2" <?= $itemFamous->price == "2" ? "checked" : "" ?> id="2">
            </div>
            <div>
              <label for="3">30% 할인</label>
              <input type="radio" name="discount" value="3" <?= $itemFamous->price == "3" ? "checked" : "" ?> id="3">

            <?php

          }

            ?>


            </div>
          </div>



          <div>
            <input type="submit" value="수정">
          </div>
    </form>



  </div>
  <script src="./js/file.js"></script>
</body>

</html>
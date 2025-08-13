<?php

require_once "db.php";
require_once "lib.php";


$title = $_POST["title"];
$des = $_POST["des"];
$idx = $_POST["idx"];
$cate = $_POST["cate"];
$price = $_POST["price"];
$file = $_FILES["file"];
$path = "images/item";
$desPath = $path . "/" . $file["name"];




  if (move_uploaded_file($file["tmp_name"], $desPath)) {
    echo "성공";
    DB::exec("INSERT INTO item( img, cate, des, title, dis) VALUES ('$desPath','$cate','$des','$title','$price')");
    move();
  } else {
    echo "실패";
  }

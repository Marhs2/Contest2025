<?php

require_once "db.php";
require_once "lib.php";


$title = $_POST["title"];
$des = $_POST["des"];
$idx = $_POST["idx"];
$cate = $_POST["cate"];
$price = $_POST["price"];
$discount = $_POST["discount"];
$file = $_FILES["file"];
$path = "images/item";
$desPath = $path . "/" . $file["name"];




if (!isset($file)) {
  if (move_uploaded_file($file["tmp_name"], $desPath)) {
    echo "성공";
    DB::exec("UPDATE item SET img='$desPath',cate='$cate',dis='$price',des='$des',title='$title',price='$discount' WHERE idx = $idx");
    move();
  } else {
    echo "실패";
  }
} else {
  echo "성공";
  DB::exec("UPDATE item SET cate='$cate',dis='$price',des='$des',title='$title' ,price='$discount' WHERE idx = $idx");
  move();
}

<?php

require_once "db.php";
require_once "lib.php";

$userId = $_SESSION["ss"]->id ?? false;
$itemId = $_GET["idx"];


if ($userId) {

  if (DB::fetch("select * from cart where itemId = $itemId and userId = '$userId' ")) {
    DB::exec("UPDATE cart SET count= count +1 WHERE itemId = $itemId and userId = '$userId'");
  } else {
    DB::exec("INSERT INTO cart(userId, itemId) VALUES ('$userId','$itemId')");
  }
  echo "장바구니에 추가했습니다";
} else {
  echo "로그인을 해주세요";
}

<?php
// 장바구니 담기 (JSON 응답)
require_once "lib.php";
header("Content-Type: application/json; charset=utf-8");

function respond($data)
{
  echo json_encode($data, JSON_UNESCAPED_UNICODE);
  exit;
}

$user = currentUser();
if (!$user) {
  respond(["ok" => false, "needLogin" => true, "msg" => "로그인 후 장바구니를 이용할 수 있습니다."]);
}

$idx = (int)($_POST["idx"] ?? 0);
$item = DB::fetch("SELECT idx, title FROM item WHERE idx = ?", [$idx]);
if (!$item) {
  respond(["ok" => false, "msg" => "상품을 찾을 수 없습니다."]);
}

// 이미 담긴 상품이면 수량 +1
DB::exec(
  "INSERT INTO cart (userId, itemId, count) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE count = count + 1",
  [$user["id"], $idx]
);

$count = (int)DB::fetch("SELECT COALESCE(SUM(count), 0) AS n FROM cart WHERE userId = ?", [$user["id"]])->n;
respond(["ok" => true, "msg" => "‘{$item->title}’을(를) 장바구니에 담았습니다.", "count" => $count]);

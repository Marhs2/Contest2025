<?php
// 장바구니 수량 변경 / 삭제 (JSON 응답) - 변경 내용을 DB에 저장해 재로그인 후에도 유지
require_once "lib.php";
header("Content-Type: application/json; charset=utf-8");

$user = currentUser();
if (!$user) {
  echo json_encode(["ok" => false, "msg" => "로그인이 필요합니다."], JSON_UNESCAPED_UNICODE);
  exit;
}

$idx = (int)($_POST["idx"] ?? 0);
$type = $_POST["type"] ?? "";

if ($type === "count") {
  $count = max(1, min(99, (int)($_POST["count"] ?? 1)));
  DB::exec("UPDATE cart SET count = ? WHERE userId = ? AND itemId = ?", [$count, $user["id"], $idx]);
} elseif ($type === "remove") {
  DB::exec("DELETE FROM cart WHERE userId = ? AND itemId = ?", [$user["id"], $idx]);
} elseif ($type === "clear") {
  DB::exec("DELETE FROM cart WHERE userId = ?", [$user["id"]]);
}

$total = (int)DB::fetch("SELECT COALESCE(SUM(count), 0) AS n FROM cart WHERE userId = ?", [$user["id"]])->n;
echo json_encode(["ok" => true, "count" => $total], JSON_UNESCAPED_UNICODE);

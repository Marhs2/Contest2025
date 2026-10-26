<?php
// 메인 공지사항 목록 (유형 필터 + 날짜 정렬) JSON 응답
require_once "lib.php";
header("Content-Type: application/json; charset=utf-8");

$type = $_GET["type"] ?? "all";
$order = ($_GET["order"] ?? "desc") === "asc" ? "ASC" : "DESC";

if (in_array($type, ["일반", "이벤트"], true)) {
  $rows = DB::fetchAll("SELECT idx, type, title, date FROM notice WHERE type = ? ORDER BY date $order, idx $order", [$type]);
} else {
  $rows = DB::fetchAll("SELECT idx, type, title, date FROM notice ORDER BY date $order, idx $order");
}

echo json_encode($rows, JSON_UNESCAPED_UNICODE);

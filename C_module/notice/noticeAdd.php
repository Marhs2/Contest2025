<?php
// 공지사항 추가
require_once "../lib.php";
requireAdmin();

$type = $_POST["type"] ?? "";
$title = trim($_POST["title"] ?? "");
$date = $_POST["date"] ?? "";

if (!in_array($type, ["일반", "이벤트"], true) || $title === "" || !strtotime($date)) {
  alertMove("유형, 제목, 공지일자를 모두 입력해주세요.", "../noticeAdd.php");
}

DB::exec("INSERT INTO notice (type, title, date) VALUES (?, ?, ?)", [$type, $title, $date]);
alertMove("공지사항을 추가했습니다.", "../noticeLists.php");

<?php
// 공지사항 수정
require_once "../lib.php";
requireAdmin();

$idx = (int)($_POST["idx"] ?? 0);
$type = $_POST["type"] ?? "";
$title = trim($_POST["title"] ?? "");
$date = $_POST["date"] ?? "";

if (!in_array($type, ["일반", "이벤트"], true) || $title === "" || !strtotime($date)) {
  alertMove("유형, 제목, 공지일자를 모두 입력해주세요.", "../noticeEdit.php?idx=$idx");
}

DB::exec("UPDATE notice SET type = ?, title = ?, date = ? WHERE idx = ?", [$type, $title, $date, $idx]);
alertMove("공지사항을 수정했습니다.", "../noticeLists.php");

<?php
// 공지사항 삭제
require_once "../lib.php";
requireAdmin();

DB::exec("DELETE FROM notice WHERE idx = ?", [(int)($_GET["idx"] ?? 0)]);
alertMove("공지사항을 삭제했습니다.", "../noticeLists.php");

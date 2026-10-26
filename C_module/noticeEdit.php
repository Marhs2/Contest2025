<?php
$pageTitle = "공지사항 수정";
$pageId = "admin";
require_once "lib.php";
requireAdmin();

$notice = DB::fetch("SELECT * FROM notice WHERE idx = ?", [(int)($_GET["idx"] ?? 0)]);
if (!$notice) alertMove("공지사항을 찾을 수 없습니다.", "./noticeLists.php");

require_once "parts/head.php";
require "parts/noticeForm.php";
require_once "parts/footer.php";
?>
</body>

</html>

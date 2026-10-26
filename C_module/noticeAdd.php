<?php
$pageTitle = "공지사항 추가";
$pageId = "admin";
require_once "lib.php";
requireAdmin();
require_once "parts/head.php";
$notice = null;
require "parts/noticeForm.php";
require_once "parts/footer.php";
?>
</body>

</html>

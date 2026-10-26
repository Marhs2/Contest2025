<?php
$pageTitle = "상품 수정";
$pageId = "admin";
require_once "lib.php";
requireAdmin();

$item = DB::fetch("SELECT * FROM item WHERE idx = ?", [(int)($_GET["idx"] ?? 0)]);
if (!$item) alertMove("상품을 찾을 수 없습니다.", "./itemList.php");

require_once "parts/head.php";
require "parts/itemForm.php";
require_once "parts/footer.php";
?>
<script src="./js/itemForm.js"></script>
</body>

</html>

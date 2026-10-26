<?php
$pageTitle = "상품 추가";
$pageId = "admin";
require_once "lib.php";
requireAdmin();
require_once "parts/head.php";
$item = null;
require "parts/itemForm.php";
require_once "parts/footer.php";
?>
<script src="./js/itemForm.js"></script>
</body>

</html>

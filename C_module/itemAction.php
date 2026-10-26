<?php
// 판매상품 수정 처리
require_once "parts/itemSave.php";
requireAdmin();

$idx = (int)($_POST["idx"] ?? 0);
if (!DB::fetch("SELECT idx FROM item WHERE idx = ?", [$idx])) {
  alertMove("상품을 찾을 수 없습니다.", "./itemList.php");
}
saveItem($idx);

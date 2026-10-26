<?php
// 판매상품 삭제 (장바구니에 담긴 같은 상품도 함께 정리)
require_once "lib.php";
requireAdmin();

$idx = (int)($_GET["idx"] ?? 0);
DB::exec("DELETE FROM item WHERE idx = ?", [$idx]);
DB::exec("DELETE FROM cart WHERE itemId = ?", [$idx]);

alertMove("상품을 삭제했습니다.", "./itemList.php");

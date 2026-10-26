<?php
// 로그아웃 (장바구니는 DB에 남아 다음 로그인 때 그대로 보인다)
require_once "lib.php";

$_SESSION = [];
session_destroy();

alertMove("로그아웃되었습니다.");

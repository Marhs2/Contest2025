<?php
// 공통 함수 모음
require_once __DIR__ . "/db.php";

// 판매상품 카테고리 (화면 표시 순서)
const CATES = ["건강식품", "디지털", "팬시", "향수", "헤어케어"];

// 인기상품 할인방법
const SALES = [1 => "만원할인", 2 => "10%할인", 3 => "30%할인"];

// HTML 출력용 이스케이프
function e($str)
{
  return htmlspecialchars((string)$str, ENT_QUOTES, "UTF-8");
}

// 금액 표시 (예: 75,000)
function won($num)
{
  return number_format((int)$num);
}

// 할인 적용 가격 계산
function salePrice($item)
{
  $price = (int)$item->price;
  return match ((int)$item->sale) {
    1 => max(0, $price - 10000),
    2 => (int)round($price * 0.9),
    3 => (int)round($price * 0.7),
    default => $price,
  };
}

// 할인 뱃지 문구
function saleBadge($item)
{
  return match ((int)$item->sale) {
    1 => "1만원 할인",
    2 => "10% 할인",
    3 => "30% 할인",
    default => "",
  };
}

// 로그인한 회원 정보 (없으면 null)
function currentUser()
{
  return $_SESSION["user"] ?? null;
}

function isAdmin()
{
  $user = currentUser();
  return $user && (int)$user["isAd"] === 1;
}

// 알림창을 띄운 뒤 이동 (메시지는 JSON으로 감싸 따옴표가 깨지지 않게 한다)
function alertMove($msg, $to = "./index.php")
{
  $m = json_encode($msg, JSON_UNESCAPED_UNICODE);
  $t = json_encode($to, JSON_UNESCAPED_UNICODE);
  echo "<!DOCTYPE html><meta charset='utf-8'><script>alert($m);location.replace($t);</script>";
  exit;
}

// 관리자 전용 페이지 보호
function requireAdmin()
{
  if (!isAdmin()) {
    alertMove("관리자만 이용할 수 있습니다.");
  }
}

// 카테고리별 상품 목록 (인기상품이 맨 위, 그다음 등록순)
function itemsByCate($order = "")
{
  $sort = match ($order) {
    "asc" => "regDate ASC, idx ASC",
    "desc" => "regDate DESC, idx DESC",
    default => "sale > 0 DESC, regDate ASC, idx ASC",
  };
  $result = [];
  foreach (CATES as $cate) {
    $result[$cate] = DB::fetchAll("SELECT * FROM item WHERE cate = ? ORDER BY $sort", [$cate]);
  }
  return $result;
}

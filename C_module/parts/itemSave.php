<?php
// 판매상품 추가/수정 공통 저장 처리
require_once __DIR__ . "/../lib.php";

function saveItem($idx = null)
{
  $back = $idx ? "./editItem.php?idx=$idx" : "./addItem.php";

  $title = trim($_POST["title"] ?? "");
  $des = trim($_POST["des"] ?? "");
  $cate = $_POST["cate"] ?? "";
  $price = (int)preg_replace('/[^0-9]/', "", $_POST["price"] ?? "");
  $famous = isset($_POST["famous"]);
  $sale = $famous ? (int)($_POST["sale"] ?? 0) : 0;
  $file = $_FILES["file"] ?? null;
  $hasFile = $file && $file["error"] === UPLOAD_ERR_OK;

  // 누락 항목 확인 (하나라도 빠지면 알림)
  $missing = [];
  if (!$idx && !$hasFile) $missing[] = "상품사진";
  if ($title === "") $missing[] = "상품명";
  if ($des === "") $missing[] = "상품설명";
  if ($price <= 0) $missing[] = "가격";
  if (!in_array($cate, CATES, true)) $missing[] = "카테고리";
  if ($missing) {
    alertMove(implode(", ", $missing) . "을(를) 입력해주세요.", $back);
  }
  if ($famous && !isset(SALES[$sale])) {
    alertMove("인기상품은 할인방법(만원할인, 10%할인, 30%할인) 중 하나를 선택해야 합니다.", $back);
  }

  // 사진 업로드 (이미지 파일만 허용, 이름이 겹치지 않게 저장)
  $imgPath = null;
  if ($hasFile) {
    $info = @getimagesize($file["tmp_name"]);
    $ext = [IMAGETYPE_PNG => "png", IMAGETYPE_JPEG => "jpg", IMAGETYPE_GIF => "gif", IMAGETYPE_WEBP => "webp"][$info[2] ?? 0] ?? null;
    if (!$ext) {
      alertMove("상품사진은 PNG, JPG, GIF, WEBP 이미지만 올릴 수 있습니다.", $back);
    }
    $dir = __DIR__ . "/../images/item";
    if (!is_dir($dir)) mkdir($dir, 0775, true);
    $name = date("YmdHis") . "_" . bin2hex(random_bytes(4)) . "." . $ext;
    if (!move_uploaded_file($file["tmp_name"], "$dir/$name")) {
      alertMove("사진을 저장하지 못했습니다. 다시 시도해주세요.", $back);
    }
    $imgPath = "./images/item/$name";
  }

  // 인기상품은 카테고리별 1개: 새로 지정하면 기존 인기상품은 해제
  if ($sale > 0) {
    DB::exec("UPDATE item SET sale = 0 WHERE cate = ? AND idx <> ?", [$cate, (int)$idx]);
  }

  // 추가완료/수정완료 시점이 등록시간
  if ($idx) {
    $sql = "UPDATE item SET cate = ?, title = ?, des = ?, price = ?, sale = ?, regDate = NOW()";
    $params = [$cate, $title, $des, $price, $sale];
    if ($imgPath) {
      $sql .= ", img = ?";
      $params[] = $imgPath;
    }
    $params[] = $idx;
    DB::exec("$sql WHERE idx = ?", $params);
    alertMove("상품을 수정했습니다.", "./itemList.php");
  }

  DB::exec(
    "INSERT INTO item (cate, title, des, price, sale, img, regDate) VALUES (?, ?, ?, ?, ?, ?, NOW())",
    [$cate, $title, $des, $price, $sale, $imgPath]
  );
  alertMove("상품을 추가했습니다.", "./itemList.php");
}

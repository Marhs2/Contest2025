<?php
// 모든 페이지 공통 <head> 와 헤더
// 사용 전 $pageTitle, $pageId 를 지정한다
require_once __DIR__ . "/../lib.php";
$pageTitle ??= "GIFTS:Mall";
$pageId ??= "";
?>
<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= e($pageTitle) ?> | GIFTS:Mall</title>
  <link rel="icon" href="./images/logo.svg" type="image/svg+xml" />
  <!-- 본문 서체: Pretendard (없으면 시스템 고딕) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css" />
  <link rel="stylesheet" href="./asaset/fontawesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="./css/style.css" />
</head>

<body class="page-<?= e($pageId) ?>">
  <?php require __DIR__ . "/header.php"; ?>

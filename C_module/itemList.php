<?php
$pageTitle = "판매상품관리";
$pageId = "admin";
require_once "lib.php";
requireAdmin();
require_once "parts/head.php";
require_once "parts/card.php";

// 등록시간 기준 정렬 (기본: 최신순)
$order = ($_GET["order"] ?? "desc") === "asc" ? "asc" : "desc";
$all = itemsByCate($order);
$adminTab = "item";
?>

<main class="main">
  <section class="page-head row">
    <div>
      <h1 class="page-title">판매상품관리</h1>
      <p class="page-lead">카테고리별 인기상품은 1개만 지정할 수 있습니다.</p>
    </div>
    <a href="./addItem.php" class="btn btn-primary"><i class="fa fa-plus"></i> 상품 추가</a>
  </section>
  <?php require "parts/adminNav.php"; ?>

  <div class="list-tools">
    <span class="muted">등록시간 정렬</span>
    <div class="seg">
      <a href="?order=asc" class="<?= $order === "asc" ? "active" : "" ?>">Asc 오래된순</a>
      <a href="?order=desc" class="<?= $order === "desc" ? "active" : "" ?>">Desc 최신순</a>
    </div>
  </div>

  <?php foreach ($all as $cate => $items) { ?>
    <section class="cate-block">
      <h2 class="cate-title"><?= e($cate) ?> <small><?= count($items) ?>개</small></h2>
      <?php if ($items) { ?>
        <div class="grid grid-5">
          <?php foreach ($items as $item) productCard($item, "admin"); ?>
        </div>
      <?php } else { ?>
        <p class="empty">등록된 상품이 없습니다.</p>
      <?php } ?>
    </section>
  <?php } ?>
</main>

<?php require_once "parts/footer.php"; ?>
</body>

</html>

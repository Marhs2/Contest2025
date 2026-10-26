<?php
$pageTitle = "인기상품";
$pageId = "sub03";
require_once "parts/head.php";
require_once "parts/card.php";

// 카테고리별 인기상품 1개씩
$popular = [];
foreach (CATES as $cate) {
  $item = DB::fetch("SELECT * FROM item WHERE cate = ? AND sale > 0 ORDER BY regDate DESC LIMIT 1", [$cate]);
  if ($item) $popular[$cate] = $item;
}
?>

<main class="main">
  <section class="page-head">
    <h1 class="page-title">인기상품</h1>
    <p class="page-lead">카테고리마다 한 가지씩, 지금 할인 중인 대표 선물이에요.</p>
  </section>

  <?php if (!$popular) { ?>
    <p class="empty">지정된 인기상품이 없습니다.</p>
  <?php } else { ?>
    <div class="popular-list">
      <?php foreach ($popular as $cate => $item) { ?>
        <div class="popular-item">
          <h2 class="cate-title"><?= e($cate) ?></h2>
          <?php productCard($item, "shop"); ?>
        </div>
      <?php } ?>
    </div>
  <?php } ?>
</main>

<?php require_once "parts/footer.php"; ?>
</body>

</html>

<?php
$pageTitle = "장바구니";
$pageId = "sub04";
require_once "parts/head.php";

$user = currentUser();
$rows = [];
if ($user) {
  $rows = DB::fetchAll(
    "SELECT i.*, c.count FROM cart c JOIN item i ON i.idx = c.itemId WHERE c.userId = ? ORDER BY c.idx",
    [$user["id"]]
  );
}
$total = 0;
foreach ($rows as $r) $total += salePrice($r) * $r->count;
?>

<main class="main">
  <section class="page-head">
    <h1 class="page-title">장바구니</h1>
  </section>

  <?php if (!$user) { ?>
    <div class="empty-state">
      <i class="fa fa-shopping-cart" aria-hidden="true"></i>
      <p>로그인하면 담아둔 상품을 볼 수 있어요.</p>
      <button type="button" class="btn btn-primary" data-open="loginModal">로그인</button>
    </div>
  <?php } elseif (!$rows) { ?>
    <div class="empty-state">
      <i class="fa fa-shopping-cart" aria-hidden="true"></i>
      <p>장바구니가 비어 있습니다.</p>
      <a href="./sub02.php" class="btn btn-primary">전체상품 보러가기</a>
    </div>
  <?php } else { ?>
    <div class="cart-layout">
      <div class="cart-list" role="table" aria-label="장바구니 상품">
        <div class="cart-row cart-head" role="row">
          <span role="columnheader">상품</span>
          <span role="columnheader">수량</span>
          <span role="columnheader">단가</span>
          <span role="columnheader">구매금액</span>
          <span role="columnheader"><span class="sr-only">삭제</span></span>
        </div>
        <?php foreach ($rows as $r) {
          $unit = salePrice($r); ?>
          <div class="cart-row" role="row" data-id="<?= (int)$r->idx ?>" data-price="<?= $unit ?>">
            <div class="cart-product" role="cell">
              <img src="<?= e($r->img) ?>" alt="<?= e($r->title) ?>" title="<?= e($r->title) ?>" />
              <div>
                <p class="cart-name"><?= e($r->title) ?></p>
                <?php if ((int)$r->sale > 0) { ?><span class="badge-sale inline"><?= e(saleBadge($r)) ?></span><?php } ?>
              </div>
            </div>
            <div class="stepper" role="cell">
              <button type="button" data-step="-1" aria-label="수량 빼기"><i class="fa fa-minus"></i></button>
              <input type="number" min="1" max="99" value="<?= (int)$r->count ?>" aria-label="<?= e($r->title) ?> 수량" />
              <button type="button" data-step="1" aria-label="수량 더하기"><i class="fa fa-plus"></i></button>
            </div>
            <div class="cart-unit" role="cell">
              <?= won($unit) ?>원
              <?php if ((int)$r->sale > 0) { ?><del><?= won($r->price) ?>원</del><?php } ?>
            </div>
            <div class="cart-amount" role="cell"><b><?= won($unit * $r->count) ?></b>원</div>
            <div role="cell">
              <button type="button" class="icon-btn sm" data-remove aria-label="<?= e($r->title) ?> 삭제"><i class="fa fa-times"></i></button>
            </div>
          </div>
        <?php } ?>
      </div>

      <aside class="summary">
        <h2>결제 정보</h2>
        <p class="summary-row"><span>상품 수</span><b id="cartQty"><?= array_sum(array_map(fn($r) => (int)$r->count, $rows)) ?>개</b></p>
        <p class="summary-total"><span>전체 결제금액</span><strong><span id="cartTotal"><?= won($total) ?></span>원</strong></p>
        <button type="button" class="btn btn-primary btn-block btn-lg" id="checkout">구매하기</button>
      </aside>
    </div>
  <?php } ?>
</main>

<?php require_once "parts/footer.php"; ?>
<script src="./js/sub04.js"></script>
</body>

</html>

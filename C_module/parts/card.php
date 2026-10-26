<?php
// 상품 카드 출력
// $mode: "shop"(구매/장바구니 버튼), "admin"(수정/삭제), "plain"(버튼 없음)
function productCard($item, $mode = "shop")
{
  $isSale = (int)$item->sale > 0;
  $final = salePrice($item);
?>
  <article class="card<?= $isSale ? " is-sale" : "" ?>" data-id="<?= (int)$item->idx ?>">
    <div class="card-img">
      <img src="<?= e($item->img) ?>" alt="<?= e($item->title) ?>" title="<?= e($item->title) ?>" loading="lazy" />
      <?php if ($isSale) { ?>
        <span class="badge-sale"><?= e(saleBadge($item)) ?></span>
      <?php } ?>
    </div>
    <div class="card-body">
      <h3 class="card-title"><?= e($item->title) ?></h3>
      <p class="card-des"><?= e($item->des) ?></p>
      <p class="card-price">
        <strong><?= won($final) ?><small>원</small></strong>
        <?php if ($isSale) { ?><del><?= won($item->price) ?>원</del><?php } ?>
      </p>
      <?php if ($mode === "admin") { ?>
        <p class="card-meta">등록 <?= e(date("Y.m.d H:i", strtotime($item->regDate))) ?></p>
      <?php } ?>
    </div>
    <?php if ($mode === "shop") { ?>
      <div class="card-actions">
        <button type="button" class="btn btn-line" data-cart-add="<?= (int)$item->idx ?>">장바구니담기</button>
        <button type="button" class="btn btn-primary" data-buy="<?= (int)$item->idx ?>">구매하기</button>
      </div>
    <?php } elseif ($mode === "admin") { ?>
      <div class="card-actions">
        <a class="btn btn-line" href="./editItem.php?idx=<?= (int)$item->idx ?>">수정</a>
        <a class="btn btn-danger-line" href="./delItem.php?idx=<?= (int)$item->idx ?>" data-confirm="‘<?= e($item->title) ?>’ 상품을 삭제할까요?">삭제</a>
      </div>
    <?php } ?>
  </article>
<?php
}

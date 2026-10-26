<?php
// 판매상품 추가/수정 폼 ($item 이 있으면 수정)
$isEdit = isset($item) && $item;
$populars = [];
foreach (DB::fetchAll("SELECT idx, cate, title FROM item WHERE sale > 0") as $p) {
  $populars[$p->cate] = ["idx" => (int)$p->idx, "title" => $p->title];
}
$curSale = $isEdit ? (int)$item->sale : 0;
?>
<main class="main narrow">
  <section class="page-head">
    <h1 class="page-title"><?= $isEdit ? "상품 수정" : "상품 추가" ?></h1>
  </section>

  <form class="panel form item-form" action="./<?= $isEdit ? "itemAction.php" : "additemAction.php" ?>" method="post" enctype="multipart/form-data" novalidate
    data-edit="<?= $isEdit ? 1 : 0 ?>" data-self="<?= $isEdit ? (int)$item->idx : 0 ?>"
    data-populars='<?= e(json_encode($populars, JSON_UNESCAPED_UNICODE)) ?>'>
    <?php if ($isEdit) { ?><input type="hidden" name="idx" value="<?= (int)$item->idx ?>" /><?php } ?>

    <div class="photo-field">
      <img id="preview" src="<?= $isEdit ? e($item->img) : "./images/noImg.png" ?>" alt="상품사진 미리보기" title="상품사진 미리보기" />
      <label class="field">
        <span>상품사진<?= $isEdit ? " (바꿀 때만 선택)" : "" ?></span>
        <input type="file" name="file" id="file" accept="image/*" />
      </label>
    </div>

    <label class="field">
      <span>카테고리</span>
      <select name="cate" id="cate">
        <?php foreach (CATES as $c) { ?>
          <option value="<?= e($c) ?>" <?= $isEdit && $item->cate === $c ? "selected" : "" ?>><?= e($c) ?></option>
        <?php } ?>
      </select>
    </label>
    <label class="field">
      <span>상품명</span>
      <input type="text" name="title" id="title" maxlength="100" value="<?= $isEdit ? e($item->title) : "" ?>" />
    </label>
    <label class="field">
      <span>상품설명</span>
      <textarea name="des" id="des" rows="3"><?= $isEdit ? e($item->des) : "" ?></textarea>
    </label>
    <label class="field">
      <span>가격 (원래 가격, 원)</span>
      <input type="number" name="price" id="price" min="1" step="1" value="<?= $isEdit ? (int)$item->price : "" ?>" />
    </label>

    <div class="famous-box">
      <label class="check">
        <input type="checkbox" name="famous" id="famous" <?= $curSale ? "checked" : "" ?> />
        <span>인기상품으로 지정</span>
      </label>
      <p class="hint" id="famousHint"></p>
      <fieldset class="sale-options" id="saleOptions" <?= $curSale ? "" : "hidden" ?>>
        <legend>할인방법 (필수)</legend>
        <div class="seg">
          <?php foreach (SALES as $v => $label) { ?>
            <label><input type="radio" name="sale" value="<?= $v ?>" <?= $curSale === $v ? "checked" : "" ?> /><span><?= e($label) ?></span></label>
          <?php } ?>
        </div>
      </fieldset>
    </div>

    <div class="form-actions">
      <a href="./itemList.php" class="btn btn-line">취소</a>
      <button type="submit" class="btn btn-primary"><?= $isEdit ? "수정완료" : "추가완료" ?></button>
    </div>
  </form>
</main>

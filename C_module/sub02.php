<?php
$pageTitle = "전체상품";
$pageId = "sub02";
require_once "parts/head.php";
require_once "parts/card.php";

$all = itemsByCate();

// 비회원 주문 모달에서 쓸 상품 데이터 (할인 적용가 포함)
$guestData = [];
foreach ($all as $cate => $items) {
  foreach ($items as $it) {
    $guestData[] = [
      "idx" => (int)$it->idx,
      "cate" => $cate,
      "title" => $it->title,
      "img" => $it->img,
      "price" => salePrice($it),
      "origin" => (int)$it->price,
      "badge" => saleBadge($it),
    ];
  }
}
?>

<main class="main">
  <!-- 광고 동영상 (컨트롤러는 영상 프레임 안에 위치) -->
  <section class="player" id="player">
    <video src="./asaset/AD.mp4" playsinline preload="metadata" title="GIFTS:Mall 광고 영상"></video>
    <div class="player-status" aria-live="polite">
      <span id="vRate">1.0x</span>
      <span id="vLoop">반복 꺼짐</span>
      <span id="vAuto">자동재생 꺼짐</span>
    </div>
    <div class="player-bar">
      <div class="player-controls" id="playerControls">
        <button type="button" data-v="play" title="재생"><i class="fa fa-play"></i><span>재생</span></button>
        <button type="button" data-v="pause" title="일시정지"><i class="fa fa-pause"></i><span>일시정지</span></button>
        <button type="button" data-v="stop" title="정지"><i class="fa fa-stop"></i><span>정지</span></button>
        <button type="button" data-v="back" title="10초 되감기"><i class="fa fa-backward"></i><span>10초 뒤로</span></button>
        <button type="button" data-v="forward" title="10초 빨리감기"><i class="fa fa-forward"></i><span>10초 앞으로</span></button>
        <button type="button" data-v="slower" title="0.1배 감속"><i class="fa fa-minus"></i><span>감속 0.1</span></button>
        <button type="button" data-v="faster" title="0.1배 배속"><i class="fa fa-plus"></i><span>배속 0.1</span></button>
        <button type="button" data-v="normal" title="배속 원래대로"><i class="fa fa-undo"></i><span>1배속</span></button>
        <button type="button" data-v="loop" title="반복 켜기/끄기" aria-pressed="false"><i class="fa fa-repeat"></i><span>반복</span></button>
        <button type="button" data-v="auto" title="자동재생 켜기/끄기" aria-pressed="false"><i class="fa fa-magic"></i><span>자동재생</span></button>
      </div>
      <button type="button" class="player-toggle" data-v="toggle" aria-controls="playerControls" aria-expanded="true" title="컨트롤러 보이기/숨기기">
        <i class="fa fa-sliders"></i><span>컨트롤러 숨기기</span>
      </button>
    </div>
  </section>

  <section class="page-head">
    <h1 class="page-title">전체상품</h1>
    <p class="page-lead">카테고리마다 인기상품을 맨 위에 모았어요.</p>
  </section>

  <?php foreach ($all as $cate => $items) { ?>
    <section class="cate-block" id="cate-<?= e($cate) ?>">
      <h2 class="cate-title"><?= e($cate) ?> <small><?= count($items) ?>개</small></h2>
      <div class="grid grid-5">
        <?php foreach ($items as $item) productCard($item, "shop"); ?>
      </div>
    </section>
  <?php } ?>

  <div class="guest-cta">
    <p>회원가입 없이 바로 주문하고 싶으신가요?</p>
    <button type="button" class="btn btn-primary btn-lg" id="guestOpen">비회원주문</button>
  </div>
</main>

<!-- 비회원 결제 완료 메시지 (3초) -->
<div class="paid-banner" role="status" aria-live="polite" hidden></div>

<!-- 비회원 주문 모달 -->
<dialog class="modal guest-modal" id="guestModal" aria-labelledby="guestTitle">
  <div class="guest">
    <div class="modal-head">
      <h2 id="guestTitle"><span class="tag tag-guest">비회원</span> 비회원 주문</h2>
      <button type="button" class="icon-btn" data-close aria-label="닫기"><i class="fa fa-times"></i></button>
    </div>

    <!-- 회원정보영역 -->
    <section class="g-area g-info">
      <h3>회원정보</h3>
      <p>비회원 ID <b id="guestId">------</b></p>
      <p class="muted">상품을 끌어서 오른쪽 주문 목록에 놓으세요. 주문 목록 밖으로 끌어내면 선택이 취소됩니다.</p>
    </section>

    <!-- 전시영역 -->
    <section class="g-area g-display">
      <h3>상품 전시</h3>
      <div class="g-display-list" id="guestDisplay"></div>
    </section>

    <!-- 주문영역 -->
    <section class="g-area g-order" id="guestOrder">
      <h3>주문 목록</h3>
      <div class="g-order-list" id="guestOrderList">
        <p class="g-empty">여기에 상품을 끌어다 놓으세요</p>
      </div>
    </section>

    <!-- 결제영역 -->
    <section class="g-area g-pay">
      <h3>결제</h3>
      <p class="g-total">총 결제금액 <strong><span id="guestTotal">0</span>원</strong></p>
      <button type="button" class="btn btn-primary btn-block" id="guestSubmit">주문하기</button>
    </section>
  </div>
</dialog>

<?php require_once "parts/footer.php"; ?>
<script>
  // 비회원 주문용 상품 목록 (서버에서 전달)
  const GUEST_ITEMS = <?= json_encode($guestData, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?>;
  const CATES = <?= json_encode(CATES, JSON_UNESCAPED_UNICODE) ?>;
</script>
<script src="./js/sub02.js"></script>
</body>

</html>

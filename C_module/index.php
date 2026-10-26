<?php
$pageTitle = "홈";
$pageId = "main";
require_once "parts/head.php";
require_once "parts/card.php";

// 메인 판매상품: 카테고리별 3개 (인기상품 우선)
$mainItems = itemsByCate();

$slides = [
  ["img" => "slide01.jpg", "title" => "Better Give & Take", "sub" => "옴니채널 플랫폼 GIFTS로<br />전 세계 고객에게 선물의 가치를 높입니다."],
  ["img" => "slide02.jpg", "title" => "Life Style Platforms", "sub" => "고객과 가장 가까운 곳에서<br />고객에게 다양한 즐거움을 선물합니다."],
  ["img" => "slide03.jpg", "title" => "Online PLAYGROUND", "sub" => "업계 최초 당일 배송 서비스인 '오늘드림'으로<br />고객 니즈 충족과 고객 경험을 혁신합니다."],
];
?>

<!-- 로딩 애니메이션 (접속/새로고침 시 약 3.5초) -->
<div class="loader" aria-hidden="true">
  <div class="loader-box">
    <span class="loader-lid"></span>
    <span class="loader-body"></span>
    <span class="loader-ribbon"></span>
  </div>
  <p class="loader-text">선물을 포장하고 있어요</p>
</div>

<!-- 비주얼 이미지 영역 -->
<section class="hero" aria-roledescription="carousel" aria-label="GIFTS:Mall 소개">
  <div class="hero-track">
    <?php
    // 마지막에 1번 슬라이드를 복제해 1→2→3→1 순서로 끊김 없이 반복
    foreach ([...$slides, $slides[0]] as $i => $s) { ?>
      <div class="hero-slide" <?= $i === 3 ? 'aria-hidden="true"' : "" ?>>
        <div class="hero-copy">
          <p class="hero-count"><?= ($i % 3) + 1 ?> / 3</p>
          <h2 class="hero-title"><?= e($s["title"]) ?></h2>
          <p class="hero-sub"><?= $s["sub"] ?></p>
          <a href="./sub02.php" class="btn btn-ink">선물 고르러 가기</a>
        </div>
        <div class="hero-img">
          <img src="./images/<?= $s["img"] ?>" alt="<?= e($s["title"]) ?>" title="<?= e($s["title"]) ?>" />
        </div>
        <button type="button" class="hero-arrow prev" aria-label="이전 슬라이드"><i class="fa fa-angle-left"></i></button>
        <button type="button" class="hero-arrow next" aria-label="다음 슬라이드"><i class="fa fa-angle-right"></i></button>
      </div>
    <?php } ?>
  </div>
</section>

<main class="main">
  <!-- 판매상품 섹션 -->
  <section class="section">
    <div class="section-head">
      <h2 class="section-title">카테고리별 선물</h2>
      <a href="./sub02.php" class="more">전체상품 보기</a>
    </div>
    <div class="chips" role="tablist" aria-label="상품 카테고리">
      <?php foreach (CATES as $i => $cate) { ?>
        <button type="button" class="chip<?= $i === 0 ? " active" : "" ?>" role="tab" aria-selected="<?= $i === 0 ? "true" : "false" ?>" data-tab="<?= e($cate) ?>"><?= e($cate) ?></button>
      <?php } ?>
    </div>
    <?php foreach ($mainItems as $cate => $items) { ?>
      <div class="grid grid-3 tab-panel" role="tabpanel" data-panel="<?= e($cate) ?>" <?= $cate === CATES[0] ? "" : "hidden" ?>>
        <?php foreach (array_slice($items, 0, 3) as $item) productCard($item, "plain"); ?>
      </div>
    <?php } ?>
  </section>

  <!-- 공지사항 섹션 -->
  <section class="section notice-section">
    <div class="section-head">
      <h2 class="section-title">공지사항</h2>
      <div class="pager">
        <button type="button" class="icon-btn" id="noticePrev" aria-label="이전 페이지"><i class="fa fa-angle-left"></i></button>
        <span class="pager-info"><b id="noticePage">1</b> / <span id="noticePages">1</span> 페이지</span>
        <button type="button" class="icon-btn" id="noticeNext" aria-label="다음 페이지"><i class="fa fa-angle-right"></i></button>
      </div>
    </div>

    <div class="notice-tools">
      <div class="seg" aria-label="유형">
        <button type="button" class="active" data-type="all">전체</button>
        <button type="button" data-type="일반">일반</button>
        <button type="button" data-type="이벤트">이벤트</button>
      </div>
      <div class="seg" aria-label="정렬">
        <button type="button" class="active" data-order="desc">Desc 최신순</button>
        <button type="button" data-order="asc">Asc 오래된순</button>
      </div>
    </div>

    <div class="notice-table" role="table" aria-label="공지사항 목록">
      <div class="notice-row notice-head" role="row">
        <span role="columnheader">유형</span>
        <span role="columnheader">제목</span>
        <span role="columnheader">공지일자</span>
      </div>
      <div id="noticeBody"></div>
    </div>
  </section>

  <!-- 상품입점/제휴문의 섹션 -->
  <section class="section partner">
    <div class="partner-intro">
      <p class="partner-kicker">대한민국 No.1</p>
      <h2 class="partner-title">GIFTS:Mall과 함께 할<br />WIN-WIN 파트너를 찾습니다.</h2>
      <p class="partner-sub">제휴사의 많은 지원을 기다립니다.</p>
    </div>

    <ul class="banners">
      <li><a href="#"><i class="fa fa-cart-plus" aria-hidden="true"></i><span>상품입점/제휴문의</span></a></li>
      <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i><span>문의결과조회</span></a></li>
      <li><a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i><span>전자계약시스템</span></a></li>
      <li><a href="#"><i class="fa fa-users" aria-hidden="true"></i><span>파트너시스템</span></a></li>
    </ul>

    <h3 class="steps-title">입점 절차 안내</h3>
    <ol class="steps">
      <li><i class="fa fa-user-plus"></i><b>임시회원가입</b><p>미거래 업체는 임시회원 가입/로그인 후 상담신청을 하실 수 있습니다.</p></li>
      <li><i class="fa fa-comments-o"></i><b>온라인상담</b><p>GIFTS:Mall 입점/제휴를 위해서는 온라인 상담이 선행되어야 합니다. 상담 문의 후 사이트를 통해 결과를 안내해 드립니다.</p></li>
      <li><i class="fa fa-building-o"></i><b>방문상담</b><p>온라인 상담이 긍정적일 경우, 담당MD/제휴담당자와 구체적인 상담을 진행하게 됩니다.</p></li>
      <li><i class="fa fa-star-o"></i><b>품평회</b><p>공정한 평가를 위해 상품력, 기획력, 영업력, 판촉력 등의 항목을 기준으로 내부 품평회를 진행합니다.</p></li>
      <li><i class="fa fa-shield"></i><b>신용평가</b><p>입점확정 협력사의 경우 신뢰있는 거래를 위해 신용평가를 받고 있습니다.</p></li>
      <li><i class="fa fa-pencil-square-o"></i><b>계약체결</b><p>전자계약서(또는 수기계약서)를 통해 거래계약서와 관련서류를 작성하시면 입점절차가 완료됩니다.</p></li>
    </ol>
  </section>
</main>

<?php require_once "parts/footer.php"; ?>
<script src="./js/index.js"></script>
</body>

</html>

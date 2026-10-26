<?php
$pageTitle = "소개";
$pageId = "sub01";
require_once "parts/head.php";

$intro = [
  ["고객과 가장 가까운 곳에서 정(情)을 전달합니다.", "우리는 100여개의 매장을 기반으로 고객에게 상품을 큐레이션합니다. 또한 체험형 콘텐츠와 커머스의 연계를 통해 파트너사들에게 매력적인 브랜딩, 마케팅 채널로 진화하고 있습니다."],
  ["고객의 니즈를 반영하는 온라인 PLAYGROUND를 제공합니다.", "우리는 차별화된 온라인 콘텐츠와 AI기술 기반 상품 추천을 통해 월 이용자 수 480만명, 멤버십 회원 수 1,400만명 이상의 선물 커뮤니티를 구현했습니다. 또한 업계 최초 당일 배송 서비스인 오늘드림을 실행하여 고객경험을 혁신했습니다."],
  ["전 세계에 Made in Korea 브랜드를 알립니다.", "우리는 Made in Korea 브랜드들이 세계로 뻗어 나가는 교두보 역할을 수행합니다. 2024년 런칭한 글로벌몰과 연간 약 300만명 이상의 외국인 고객이 방문하는 국내 글로벌 특화매장은 파트너사와 함께 글로벌 시장에서 동반 성장을 할 수 있는 핵심 원동력입니다."],
  ["가치지향 라이프스타일 플랫폼을 통해 고객에게 다양한 즐거움을 선물합니다.", "고객이 라이프스타일 전반에서 자신만의 가치와 취향을 반영한 브랜드를 탐색할 수 있습니다. 이러한 고객 경험의 확장을 통해 우리는 종합 라이프스타일 플랫폼으로 도약합니다."],
];

$mottos = [
  ["행복신뢰", "고객신뢰를 바탕으로 행복한 사회를 추구하는 글로벌 기업"],
  ["가치나눔", "기업의 가치 혁신의 출발은 나눔을 시작으로 고객 가치를 탐험한다."],
  ["환경선도", "세계 기후변화 대응을 위해 100% 재생에너지로 생산된 제품만 선별한다."],
  ["미래혁신", "다른 생각 다른 미래, 플랫폼 기반의 글로벌 미래 혁신을 선도한다."],
  ["정보보안", "글로벌 수준의 개인정보보호 및 보안 체계를 유지한다."],
];
?>

<main class="main">
  <section class="page-head">
    <h1 class="page-title">GIFTS:Mall을 소개합니다</h1>
    <p class="page-lead">선물의 가치를 높이는 옴니채널 라이프스타일 플랫폼</p>
  </section>

  <section class="intro">
    <figure class="intro-img">
      <img src="./images/intro.JPG" alt="GIFTS:Mall 매장" title="GIFTS:Mall 매장" />
    </figure>
    <div class="intro-list">
      <?php foreach ($intro as [$head, $body]) { ?>
        <article class="intro-item">
          <h2><?= e($head) ?></h2>
          <p><?= e($body) ?></p>
        </article>
      <?php } ?>
    </div>
  </section>

  <!-- GIFTS:Mall 모토: 항목에 마우스를 올리면 해당 이미지가 전체 칸으로 이어지고 설명이 나타난다 -->
  <section class="section motto-section" id="motto">
    <div class="section-head">
      <h2 class="section-title">GIFTS:Mall Motto</h2>
    </div>
    <div class="motto" style="--n: <?= count($mottos) ?>">
      <?php foreach ($mottos as $i => [$name, $des]) { $no = sprintf("%02d", $i + 1); ?>
        <div class="motto-col" tabindex="0" data-img="./images/motto<?= $no ?>.png" data-des="<?= e($des) ?>" style="--i: <?= $i ?>; background-image: url(./images/motto<?= $no ?>.png)">
          <span class="motto-name"><?= e($name) ?></span>
        </div>
      <?php } ?>
      <p class="motto-caption" aria-live="polite"></p>
    </div>
  </section>
</main>

<?php require_once "parts/footer.php"; ?>
<script src="./js/sub01.js"></script>
</body>

</html>

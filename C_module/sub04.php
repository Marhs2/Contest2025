<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./css/main.css" />
  <link rel="stylesheet" href="./css/sub02.css" />
  <link rel="stylesheet" href="./css/sub04.css" />

  <link
    rel="stylesheet"
    href="./asaset/fontawesome/css/font-awesome.min.css" />
</head>

<body>
  <?php require_once "./parts/header.php" ?>

  <!-- 헤더 -->

  <main>
    <div class="CART">
      <div class="title">CART</div>
      <div class="product-container">



        <?php

        $userId = $_SESSION["ss"]->id ?? false;
        if ($userId != false) {

          $items = DB::fetchAll("select i.* , c.count  from item i join cart c on i.idx = itemId and c.userId = '$userId'");




          foreach ($items as $key => $value) {
        ?>
            <div class="item" data-id="<?= $value->idx ?>">
              <div class="img-cover">
                <img
                  src="<?= $value->img ?>"
                  alt="<?= $value->idx ?>"
                  title="<?= $value->idx ?>" />
              </div>

              <div class="item-content">
                <div class="item-title"><?= $value->title ?></div>
                <div class="item-price">
                  <?php if ($value->price != "0") { ?>
                    <span class="price"> <?= $value->price ?></span>
                    <span style="text-decoration: line-through; color: gray"><?= $value->dis ?></span>
                  <?php } else { ?>
                    <span class="price"> <?= $value->dis ?></span>
                  <?php } ?>
                </div>
                <div class="count">
                  <input type="number" value="<?= $value->count ?>" min="1" onchange="priceChange()" oninput="priceChange()" />
                  <div>총: <span>65,000</span> 원</div>
                </div>
              </div>
            </div>

          <?php
          }

          ?>

        <?php } ?>

      </div>
    </div>

    <div class="checkout">
      <div class="checkoutPrice">총:<span>65,000</span>원</div>
      <div class="checkoutBtn">구매하기</div>
    </div>
  </main>

  <footer>
    <div class="howto">
      고객센터 이용안내 - 온라인몰 고객센터 1580-8282 - 매장고객센터
      1577-8254고객센터 운영시간 [평일 09:00 - 18:00]
    </div>
    <div class="time"></div>
    <div class="support">
      주말 및 공휴일은 1:1문의하기를 이용해주세요. 업무가 시작되면 바로
      처리해드립니다.
    </div>

    <div class="footer-nav">
      <a href="#"><img src="./images/logo.png" alt="footer-logo" title="footer-logo" /></a>
      <div class="other">
        <a href="#">개인정보처리방침</a> | <a href="#">이용약관.법적고지</a> |
        <a href="#">청소년보호방침</a> | <a href="#">이메일무단수집거부</a> |
        <a href="#">사이트맵</a> |
        <a href="#">채용</a>
      </div>
      <div class="Sns">
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-youtube-play"></i></a>
        <a href="#"><i class="fa fa-weixin"></i></a>
        <a href="#"><i class="fa fa-linkedin-square"></i></a>
        <a href="#"><i class="fa fa-facebook-square"></i></a>
      </div>
    </div>

    <div class="who">
      (주)GIFTS:Mall | 사업자등록번호 : 809-81-01157 | 대표이사 황기영 주소 :
      서울특별시 용산구 한강대로 123, 40층 본사 대표전화 : 02-123-4567 |
      GIFTS:Mall 가맹상담전화 : 02-123-4568
    </div>
    <div class="safe">
      지방은행구매안전서비스 GIFTS:Mall은 현금 결제한 금액에 대해 지방은행과
      채무지급보증 계약을체결하여 안전한 거래를 보장하고 있습니다 서비스
      가입사실 확인 >
    </div>
    <div class="copy">
      COPYRIGHTⓒ 2024 GIFTS:MALL KOREA INC. ALL RIGHTS RESERVED
    </div>
  </footer>
  <script src="./js/lib.js"></script>
  <script src="./js/sub04.js"></script>
  <script>
    let total = 0;
    $$(".item-price .price").forEach((e) => {
      const num = parseInt(e.textContent.replace(/[^0-9]/g, ""));
      if (num == 1) {
        e.textContent = (
          parseInt(
            e
            .closest(".item-price")
            .querySelector("span:nth-child(2)")
            .textContent.replace(/[^0-9]/g, "")
          ) - 10000
        ).toLocaleString("en-us");


        e.closest(".item").querySelector(".count span").textContent = (parseInt(
          e
          .closest(".item-price")
          .querySelector("span:nth-child(2)")
          .textContent.replace(/[^0-9]/g, "")
        ) - 10000).toLocaleString("en-us")

        total += (parseInt(
          e
          .closest(".item-price")
          .querySelector("span:nth-child(2)")
          .textContent.replace(/[^0-9]/g, "")
        ) - 10000)


      } else if (num == 2) {
        e.textContent = (
          parseInt(
            e
            .closest(".item-price")
            .querySelector("span:nth-child(2)")
            .textContent.replace(/[^0-9]/g, "")
          ) * 0.9
        ).toLocaleString("en-us");

        e.closest(".item").querySelector(".count span").textContent = (parseInt(
          e
          .closest(".item-price")
          .querySelector("span:nth-child(2)")
          .textContent.replace(/[^0-9]/g, "")
        ) * 0.9).toLocaleString("en-us")
        total += parseInt(
          e
          .closest(".item-price")
          .querySelector("span:nth-child(2)")
          .textContent.replace(/[^0-9]/g, "")
        ) * 0.9
        console.log(total)


      } else if (num == 3) {
        e.textContent = (
          parseInt(
            e
            .closest(".item-price")
            .querySelector("span:nth-child(2)")
            .textContent.replace(/[^0-9]/g, "")
          ) * 0.7
        ).toLocaleString("en-us");


        e.closest(".item").querySelector(".count span").textContent = (parseInt(
          e
          .closest(".item-price")
          .querySelector("span:nth-child(2)")
          .textContent.replace(/[^0-9]/g, "")
        ) * 0.7).toLocaleString("en-us")

        total += (parseInt(
          e
          .closest(".item-price")
          .querySelector("span:nth-child(2)")
          .textContent.replace(/[^0-9]/g, "")
        ) * 0.7)
      }
    });


    document.querySelector(".checkoutPrice span").textContent = total
  </script>

</body>

</html>
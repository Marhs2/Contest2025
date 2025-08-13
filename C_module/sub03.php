<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./css/main.css" />
  <link rel="stylesheet" href="./css/sub02.css" />
  <link
    rel="stylesheet"
    href="./asaset/fontawesome/css/font-awesome.min.css" />
</head>

<body>
  <?php require_once "./parts/header.php" ?>

  <!-- 헤더 -->

  <main>
    <div class="sale-product">
      <div class="title">POPULAR PRODUCT</div>
      <div class="product-container">

        <div class="items 건강식품">
          <?php
          $heal = DB::fetchAll("select * from item where cate = '건강식품'order by price desc");


          foreach ($heal as $key => $value) {
          ?>
            <?php if ($value->price != "0") { ?>
              <div class="item" data-id="<?= $value->idx ?>">
                <div class="img-cover">
                  <img
                    src="<?= $value->img ?>"
                    alt="<?= $value->idx ?>"
                    title="<?= $value->idx ?>" />
                </div>

                <div class="item-content">
                  <div class="item-title"><?= $value->title ?></div>
                  <div class="item-price"><span class="price"><?= $value->price ?>
                    </span>
                    <span style="text-decoration: line-through; color: gray"><?= $value->dis ?> </span>
                  </div>
                  <div class="btns">
                    <a>구매하기</a>
                    <a class="get">장바구니담기</a>
                  </div>
                </div>
              </div>
            <?php } ?>




          <?php

          } ?>

        </div>
        <div class="items 디지털">
          <?php
          $heal = DB::fetchAll("select * from item where cate = '디지털' order by price desc");


          foreach ($heal as $key => $value) {
          ?>
            <?php if ($value->price != "0") { ?>
              <div class="item" data-id="<?= $value->idx ?>">
                <div class="img-cover">
                  <img
                    src="<?= $value->img ?>"
                    alt="<?= $value->idx ?>"
                    title="<?= $value->idx ?>" />
                </div>

                <div class="item-content">
                  <div class="item-title"><?= $value->title ?></div>
                  <div class="item-price"><span class="price">
                      <?= $value->price ?> </span>
                    <span style="text-decoration: line-through; color: gray"> <?= $value->dis ?></span>
                  </div>
                  <div class="btns">
                    <a>구매하기</a>
                    <a class="get">장바구니담기</a>
                  </div>
                </div>
              </div>
            <?php } ?>




          <?php

          } ?>
        </div>
        <div class="items 팬시">
          <?php
          $heal = DB::fetchAll("select * from item where cate = '팬시'order by price desc");


          foreach ($heal as $key => $value) {
          ?>
            <?php if ($value->price != "0") { ?>
              <div class="item" data-id="<?= $value->idx ?>">
                <div class="img-cover">
                  <img
                    src="<?= $value->img ?>"
                    alt="<?= $value->idx ?>"
                    title="<?= $value->idx ?>" />
                </div>

                <div class="item-content">
                  <div class="item-title"><?= $value->title ?></div>
                  <div class="item-price"><span class="price">
                      <?= $value->price ?></span>
                    <span style="text-decoration: line-through; color: gray"> <?= $value->dis ?></span>
                  </div>
                  <div class="btns">
                    <a>구매하기</a>
                    <a class="get">장바구니담기</a>
                  </div>
                </div>
              </div>
            <?php } ?>


          <?php } ?>


        </div>
        <div class="items 향수">
          <?php
          $heal = DB::fetchAll("select * from item where cate = '향수'order by price desc");


          foreach ($heal as $key => $value) {
          ?>
            <?php if ($value->price != "0") { ?>
              <div class="item" data-id="<?= $value->idx ?>">
                <div class="img-cover">
                  <img
                    src="<?= $value->img ?>"
                    alt="<?= $value->idx ?>"
                    title="<?= $value->idx ?>" />
                </div>

                <div class="item-content">
                  <div class="item-title"><?= $value->title ?></div>
                  <div class="item-price"><span class="price">
                      <?= $value->price ?> </span>
                    <span style="text-decoration: line-through; color: gray"> <?= $value->dis ?></span>
                  </div>
                  <div class="btns">
                    <a>구매하기</a>
                    <a class="get">장바구니담기</a>
                  </div>
                </div>
              </div>
            <?php } ?>



          <?php

          } ?>
        </div>
        <div class="items 헤어케어">
          <?php
          $heal = DB::fetchAll("select * from item where cate = '헤어케어' order by price desc");


          foreach ($heal as $key => $value) {
          ?>
            <?php if ($value->price != "0") { ?>
              <div class="item" data-id="<?= $value->idx ?>">
                <div class="img-cover">
                  <img
                    src="<?= $value->img ?>"
                    alt="<?= $value->idx ?>"
                    title="<?= $value->idx ?>" />
                </div>

                <div class="item-content">
                  <div class="item-title"><?= $value->title ?></div>
                  <div class="item-price"><span class="price">
                      <?= $value->price ?> </span>
                    <span style="text-decoration: line-through; color: gray"> <?= $value->dis ?></span>
                  </div>
                  <div class="btns">
                    <a>구매하기</a>
                    <a class="get">장바구니담기</a>
                  </div>
                </div>
              </div>
            <?php } ?>


          <?php } ?>



        </div>
      </div>
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
  <script>
    $$(".item-price .price").forEach((e) => {
      const num = parseInt(e.textContent.replace(/[^0-9]/g, ""));
      if (num == 1) {
        e.textContent = e.textContent = (
          parseInt(
            e
            .closest(".item-price")
            .querySelector("span:nth-child(2)")
            .textContent.replace(/[^0-9]/g, "")
          ) - 10000
        ).toLocaleString("en-us");
      } else if (num == 2) {
        e.textContent = (
          parseInt(
            e
            .closest(".item-price")
            .querySelector("span:nth-child(2)")
            .textContent.replace(/[^0-9]/g, "")
          ) * 0.9
        ).toLocaleString("en-us");
      } else if (num == 3) {
        e.textContent = (
          parseInt(
            e
            .closest(".item-price")
            .querySelector("span:nth-child(2)")
            .textContent.replace(/[^0-9]/g, "")
          ) * 0.7
        ).toLocaleString("en-us");
      }
    });

    const buyBtns = $$(".get");

buyBtns.forEach((e) => {
  e.addEventListener("click", () => {
    fetch(`./addCart.php?idx=${e.closest(".item").getAttribute("data-id")}`)
      .then((res) => res.text())
      .then((data) => {
        alert(data);
      });
  });
});

  </script>

</body>

</html>
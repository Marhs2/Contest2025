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

  <div class="video-container">
    <video src="./asaset/AD.mp4"></video>
    <div class="contorls-container">
      <div class="controls">
        <div class="ctrl01">재생</div>
        <div class="ctrl02">일시정지</div>
        <div class="ctrl03">정지</div>
        <div class="ctrl04">되감기(10초씩)</div>
        <div class="ctrl05">빨리감기(10초씩)</div>
        <div class="ctrl06">감속하기(0.1배씩)</div>
        <div class="ctrl07">배속하기(0.1배씩)</div>
        <div class="ctrl08">배속 원래대로 돌리기</div>
        <div class="ctrl09">반복 켜기/끄기</div>
        <div class="ctrl10">자동재생 켜기/끄기</div>
      </div>
      <div class="ctrl11">컨트롤러 보이기/숨기기</div>
    </div>
  </div>

  <!-- 비디오 -->

  <main>
    <div class="sale-product">
      <div class="title">ALL PRODUCT</div>
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
            <?php } else { ?>

              <div class="item" data-id="<?= $value->idx ?>">
                <div class="img-cover">
                  <img
                    src="<?= $value->img ?>"
                    alt="<?= $value->idx ?>"
                    title="<?= $value->idx ?>" />
                </div>

                <div class="item-content">
                  <div class="item-title"><?= $value->title ?></div>
                  <div class="item-price"><span class="price"><?= $value->dis ?></span></div>
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
            <?php } else { ?>

              <div class="item" data-id="<?= $value->idx ?>">
                <div class="img-cover">
                  <img
                    src="<?= $value->img ?>"
                    alt="<?= $value->idx ?>"
                    title="<?= $value->idx ?>" />
                </div>

                <div class="item-content">
                  <div class="item-title"><?= $value->title ?></div>
                  <div class="item-price"><span class="price"><?= $value->dis ?></span></div>
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
            <?php } else { ?>

              <div class="item" data-id="<?= $value->idx ?>">
                <div class="img-cover">
                  <img
                    src="<?= $value->img ?>"
                    alt="<?= $value->idx ?>"
                    title="<?= $value->idx ?>" />
                </div>

                <div class="item-content">
                  <div class="item-title"><?= $value->title ?></div>
                  <div class="item-price"><span class="price"><?= $value->dis ?></span></div>
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
            <?php } else { ?>

              <div class="item" data-id="<?= $value->idx ?>">
                <div class="img-cover">
                  <img
                    src="<?= $value->img ?>"
                    alt="<?= $value->idx ?>"
                    title="<?= $value->idx ?>" />
                </div>

                <div class="item-content">
                  <div class="item-title"><?= $value->title ?></div>
                  <div class="item-price"><span class="price"><?= $value->dis ?></span></div>
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
          $heal = DB::fetchAll("select * from item where cate = '헤어케어'order by price desc");


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
            <?php } else { ?>

              <div class="item" data-id="<?= $value->idx ?>">
                <div class="img-cover">
                  <img
                    src="<?= $value->img ?>"
                    alt="<?= $value->idx ?>"
                    title="<?= $value->idx ?>" />
                </div>

                <div class="item-content">
                  <div class="item-title"><?= $value->title ?></div>
                  <div class="item-price"><span class="price"><?= $value->dis ?></span></div>
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
      </div>
  </main>
  <div class="user-alert">
    방금 비회원 <span class="user-name"></span>님이
    <span class="cost"></span>원을 결제하셨습니다!
  </div>
  <div class="non-user-bg">
    <div class="non-user-container">
      <header>
        <div class="userId">ID:</div>
        <div class="title">비회원 주문</div>
        <div class="close">닫기</div>
      </header>
      <main>
        <div class="cate">
          <div onclick="category('건강식품',this)" class="active">
            건강식품
          </div>
          <div onclick="category('디지털',this)">디지털</div>
          <div onclick="category('팬시',this)">팬시</div>
          <div onclick="category('향수',this)">향수</div>
          <div onclick="category('헤어케어',this)">헤어케어</div>
        </div>

        <div class="product-container cart">
          <div class="item">
            <div class="img-cover">
              <img
                src="./asaset/A-Module/images/헤어케어/4.PNG"
                alt="헤어케어3Img"
                title="헤어케어3Img" />
            </div>

            <div class="item-content">
              <div class="item-title">모로칸오일 헤어트리트먼트 100ml</div>
              <div class="item-price"><span class="price">
                  <span< /span> class="price">52,200
                </span></div>
            </div>
          </div>
        </div>
        <div class="drop product-container"></div>
      </main>
      <footer>
        <div class="checkout">
          <div class="total">총: <span>0</span>원</div>
          <div class="checoutBtn">구매하기</div>
        </div>
      </footer>
    </div>
  </div>

  <!-- 드래그앤드롭 -->

  <div class="open">비회원주문</div>
  <!-- 드래그앤드롭 열기 -->
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
  <script src="./js/sub02.js"></script>
</body>

</html>
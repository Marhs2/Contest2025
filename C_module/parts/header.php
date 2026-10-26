<?php
// 상단 고정 헤더: 심벌로고, 메뉴 내비게이션, 유틸 메뉴, 로그인/회원가입 모달
$user = currentUser();
$cartCount = 0;
if ($user) {
  $cartCount = (int)(DB::fetch("SELECT COALESCE(SUM(count), 0) AS n FROM cart WHERE userId = ?", [$user["id"]])->n ?? 0);
}
?>
<header class="site-header">
  <div class="header-inner">
    <a href="./index.php" class="logo">
      <img src="./images/logo.svg" alt="GIFTS:Mall 심벌로고" title="GIFTS:Mall 홈으로" />
    </a>

    <!-- 메뉴 내비게이션 (마우스를 올리면 전체 서브메뉴가 내려온다) -->
    <nav class="gnb" id="gnb" aria-label="주 메뉴">
      <ul class="gnb-list">
        <li class="<?= $pageId === "sub01" ? "current" : "" ?>">
          <a href="./sub01.php">소개</a>
          <ul class="sub">
            <li><a href="./sub01.php">회사소개</a></li>
            <li><a href="./sub01.php#motto">모토</a></li>
          </ul>
        </li>
        <li class="<?= in_array($pageId, ["sub02", "sub03"]) ? "current" : "" ?>">
          <a href="./sub02.php">판매상품</a>
          <ul class="sub">
            <li><a href="./sub02.php">전체상품</a></li>
            <li><a href="./sub03.php">인기상품</a></li>
          </ul>
        </li>
        <li>
          <a href="#">가맹점</a>
          <ul class="sub">
            <li><a href="#">매장찾기</a></li>
            <li><a href="#">가맹문의</a></li>
          </ul>
        </li>
        <li class="<?= $pageId === "sub04" ? "current" : "" ?>">
          <a href="./sub04.php">장바구니</a>
          <ul class="sub">
            <li><a href="./sub04.php">내 장바구니</a></li>
          </ul>
        </li>
        <?php if (isAdmin()) { ?>
          <li class="<?= $pageId === "admin" ? "current" : "" ?>">
            <a href="./noticeLists.php">관리자</a>
            <ul class="sub">
              <li><a href="./noticeLists.php">공지사항관리</a></li>
              <li><a href="./itemList.php">판매상품관리</a></li>
              <li><a href="./userLists.php">회원관리</a></li>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </nav>

    <!-- 유틸 메뉴 -->
    <ul class="util">
      <?php if (!$user) { ?>
        <li><button type="button" class="link-btn" data-open="loginModal">로그인</button></li>
        <li><button type="button" class="link-btn" data-open="regModal">회원가입</button></li>
      <?php } else { ?>
        <li class="hello"><?= e($user["name"]) ?>님</li>
        <li><a href="./logout.php">로그아웃</a></li>
      <?php } ?>
      <li>
        <a href="./sub04.php" class="cart-link" title="장바구니">
          <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          <span class="sr-only">장바구니</span>
          <span class="cart-badge" data-cart-count <?= $cartCount ? "" : "hidden" ?>><?= $cartCount ?></span>
        </a>
      </li>
      <li class="menu-toggle-wrap">
        <button type="button" class="menu-toggle" aria-controls="gnb" aria-expanded="false">
          <i class="fa fa-bars" aria-hidden="true"></i><span class="sr-only">메뉴 열기</span>
        </button>
      </li>
    </ul>
  </div>
</header>

<?php if (!$user) { ?>
  <!-- 로그인 모달 -->
  <dialog class="modal auth-modal" id="loginModal" aria-labelledby="loginTitle">
    <form action="./userAction.php" method="post" class="auth-form">
      <input type="hidden" name="type" value="login" />
      <div class="modal-head">
        <h2 id="loginTitle">로그인</h2>
        <button type="button" class="icon-btn" data-close aria-label="닫기"><i class="fa fa-times"></i></button>
      </div>
      <label class="field">
        <span>아이디</span>
        <input type="text" name="id" autocomplete="username" required />
      </label>
      <label class="field">
        <span>비밀번호</span>
        <input type="password" name="psw" autocomplete="current-password" required />
      </label>
      <button type="submit" class="btn btn-primary btn-block">로그인</button>
      <p class="modal-foot">처음이신가요? <button type="button" class="text-btn" data-open="regModal">회원가입</button></p>
    </form>
  </dialog>

  <!-- 회원가입 모달 -->
  <dialog class="modal auth-modal" id="regModal" aria-labelledby="regTitle">
    <form action="./userAction.php" method="post" class="auth-form">
      <input type="hidden" name="type" value="reg" />
      <div class="modal-head">
        <h2 id="regTitle">회원가입</h2>
        <button type="button" class="icon-btn" data-close aria-label="닫기"><i class="fa fa-times"></i></button>
      </div>
      <label class="field">
        <span>아이디</span>
        <input type="text" name="id" autocomplete="username" pattern="[A-Za-z0-9_]{3,20}" title="영문, 숫자, _ 3~20자" required />
      </label>
      <label class="field">
        <span>비밀번호</span>
        <input type="password" name="psw" autocomplete="new-password" minlength="4" required />
      </label>
      <label class="field">
        <span>이름</span>
        <input type="text" name="name" autocomplete="name" required />
      </label>
      <label class="field">
        <span>이메일</span>
        <input type="email" name="email" autocomplete="email" required />
      </label>
      <button type="submit" class="btn btn-primary btn-block">가입하기</button>
      <p class="modal-foot">이미 회원이신가요? <button type="button" class="text-btn" data-open="loginModal">로그인</button></p>
    </form>
  </dialog>
<?php } ?>

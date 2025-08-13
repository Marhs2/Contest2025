<?php

require_once "db.php";
?>

<header>
  <a href="./index.php"><img src="./images/logo.png" alt="logo" title="logo" /></a>
  <ul class="nav01">
    <li>
      <a href="./sub01.php">소개</a>
      <ul class="dropDown">
        <li><a href="#">-</a></li>
        <li><a href="#">-</a></li>
      </ul>
    </li>
    <li>
      <a href="./sub02.php">판매상품</a>
      <ul class="dropDown">
        <li><a href="./sub02.php">전체상품</a></li>
        <li><a href="./sub03.php">인기상품</a></li>
      </ul>
    </li>
    <li>
      <a href="#">가맹점</a>
      <ul class="dropDown">
        <li><a href="#">-</a></li>
        <li><a href="#">-</a></li>
      </ul>
    </li>
    <li>
      <a href="./sub04.php">장바구니</a>
      <ul class="dropDown">
        <li><a href="#">-</a></li>
        <li><a href="#">-</a></li>
      </ul>
    </li>
  </ul>
  <?php
  $user = $_SESSION["ss"] ?? null;



  if ($user == null) {

  ?>

    <ul class="nav02">
      <li>
        <a href="#" class="loginOpen">로그인</a>
      </li>
      <li>
        <a href="#" class="regOpen">회원가입</a>
      </li>

    </ul>

  <?php
  } else if ($user->isAd === 1) {
  ?>
    <ul class="nav02">


      <li>
        <a href="#">관리자</a>
        <ul class="dropDown">
          <li><a href="./noticeLists.php">공지사항관리</a></li>
          <li><a href="./itemList.php">판매상품관리</a></li>
        </ul>
      </li>

      <li>
        <a href="./userLists.php">회원관리</a>
      </li>

      <li>
        <a href="./sub04.php">장바구니</a>
      </li>

      <li>
        <a href="./logout.php">로그아웃</a>
      </li>
    </ul>


  <?php
  } else {
  ?>

    <ul class="nav02">


      <li>
        <a href="#"><?= $user->id ?>님</a>
      </li>
      <li>
        <a href="./sub04.php">장바구니</a>
      </li>
      <li>
        <a href="./logout.php">로그아웃</a>
      </li>
    </ul>

  <?php } ?>



</header>


<div class="login">

  <form action="userAction.php" method="Post">

    <div class="closeLogin">닫기</div>

    <input type="hidden" name="type" value="login">

    <div id="df">
      <h1>로그인</h1>
    </div>

    <div>
      <label for="id">아이디</label>

      <input type="text" name="id" id="id">

    </div>
    <div>
      <label for="psw">비밀번호</label>
      <input type="password" name="psw" id="psw">
    </div>

    <div>
      <input type="submit" value="로그인">
    </div>
  </form>



</div>

<div class="reg">

  <form action="userAction.php" method="Post">

    <div class="closeReg">닫기</div>

    <input type="hidden" name="type" value="reg">

    <div id="df">
      <h1>회원가입</h1>
    </div>

    <div>
      <label for="name">이름</label>

      <input type="text" name="name" id="name">
    </div>

    <div>
      <label for="id">아이디</label>

      <input type="text" name="id" id="id">
    </div>

    <div>
      <label for="psw">비밀번호</label>
      <input type="password" name="psw" id="psw">
    </div>

    <div>
      <label for="email">이메일</label>
      <input type="email" name="email" id="email">
    </div>

    <div>
      <input type="submit" value="회원가입">
    </div>
  </form>



</div>

<script>
  const login = document.querySelector(".login")
  const reg = document.querySelector(".reg")
  const closeLogin = document.querySelector(".closeLogin")
  const closeReg = document.querySelector(".closeReg")
  const loginOpen = document.querySelector(".loginOpen")
  const regOpen = document.querySelector(".regOpen")



  closeLogin.addEventListener("click", () => {
    login.style.display = "none"
  })
  closeReg.addEventListener("click", () => {
    reg.style.display = "none"
  })

  if (loginOpen, regOpen) {
    loginOpen.addEventListener("click", () => {
      login.style.display = "flex"
    })
    regOpen.addEventListener("click", () => {
      reg.style.display = "flex"
    })

  }
</script>
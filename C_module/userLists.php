<?php
$pageTitle = "회원관리";
$pageId = "admin";
require_once "lib.php";
requireAdmin();
require_once "parts/head.php";

$users = DB::fetchAll("SELECT id, name, email, salt, psw, isAd, regDate FROM user ORDER BY regDate DESC, idx DESC");
$adminTab = "user";
?>

<main class="main">
  <section class="page-head">
    <h1 class="page-title">회원관리</h1>
    <p class="page-lead">비밀번호는 SHA256(salt + 비밀번호)로 암호화되어 저장됩니다.</p>
  </section>
  <?php require "parts/adminNav.php"; ?>

  <div class="admin-table user-admin" role="table" aria-label="회원 목록">
    <div class="a-row a-head" role="row">
      <span role="columnheader">아이디</span>
      <span role="columnheader">이름 / 이메일</span>
      <span role="columnheader">salt / 해시값</span>
      <span role="columnheader">가입일시</span>
    </div>
    <?php foreach ($users as $u) { ?>
      <div class="a-row" role="row">
        <span role="cell"><b><?= e($u->id) ?></b><?php if ((int)$u->isAd === 1) { ?> <em class="tag">관리자</em><?php } ?></span>
        <span role="cell"><?= e($u->name) ?><br /><span class="muted"><?= e($u->email) ?></span></span>
        <span role="cell" class="hash"><span class="muted">salt</span> <?= e($u->salt) ?><br /><span class="muted">hash</span> <?= e($u->psw) ?></span>
        <span role="cell" class="muted"><?= e(date("Y.m.d H:i:s", strtotime($u->regDate))) ?></span>
      </div>
    <?php } ?>
  </div>
</main>

<?php require_once "parts/footer.php"; ?>
</body>

</html>

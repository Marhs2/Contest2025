<?php
$pageTitle = "공지사항관리";
$pageId = "admin";
require_once "lib.php";
requireAdmin();
require_once "parts/head.php";

$notices = DB::fetchAll("SELECT * FROM notice ORDER BY date DESC, idx DESC");
$adminTab = "notice";
?>

<main class="main">
  <section class="page-head row">
    <div>
      <h1 class="page-title">공지사항관리</h1>
      <p class="page-lead">등록한 공지는 메인 페이지 공지사항에 바로 반영됩니다.</p>
    </div>
    <a href="./noticeAdd.php" class="btn btn-primary"><i class="fa fa-plus"></i> 공지 추가</a>
  </section>
  <?php require "parts/adminNav.php"; ?>

  <div class="admin-table notice-admin" role="table" aria-label="공지사항 목록">
    <div class="a-row a-head" role="row">
      <span role="columnheader">유형</span>
      <span role="columnheader">제목</span>
      <span role="columnheader">공지일자</span>
      <span role="columnheader">관리</span>
    </div>
    <?php foreach ($notices as $n) { ?>
      <div class="a-row" role="row">
        <span role="cell"><em class="tag <?= $n->type === "이벤트" ? "tag-event" : "" ?>"><?= e($n->type) ?></em></span>
        <span role="cell" class="a-title"><?= e($n->title) ?></span>
        <span role="cell" class="muted"><?= e(str_replace("-", ".", $n->date)) ?></span>
        <span role="cell" class="a-actions">
          <a href="./noticeEdit.php?idx=<?= (int)$n->idx ?>" class="btn btn-line sm">수정</a>
          <a href="./notice/noticedel.php?idx=<?= (int)$n->idx ?>" class="btn btn-danger-line sm" data-confirm="이 공지사항을 삭제할까요?">삭제</a>
        </span>
      </div>
    <?php } ?>
    <?php if (!$notices) { ?><p class="empty">등록된 공지사항이 없습니다.</p><?php } ?>
  </div>
</main>

<?php require_once "parts/footer.php"; ?>
</body>

</html>

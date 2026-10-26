<?php
// 공지사항 추가/수정 폼 ($notice 가 있으면 수정)
$isEdit = isset($notice) && $notice;
?>
<main class="main narrow">
  <section class="page-head">
    <h1 class="page-title"><?= $isEdit ? "공지사항 수정" : "공지사항 추가" ?></h1>
  </section>
  <form class="panel form" action="./notice/<?= $isEdit ? "noticeEditAction.php" : "noticeAdd.php" ?>" method="post">
    <?php if ($isEdit) { ?><input type="hidden" name="idx" value="<?= (int)$notice->idx ?>" /><?php } ?>
    <fieldset class="field">
      <legend>유형</legend>
      <div class="seg">
        <?php foreach (["일반", "이벤트"] as $t) { ?>
          <label><input type="radio" name="type" value="<?= $t ?>" required <?= ($isEdit ? $notice->type : "일반") === $t ? "checked" : "" ?> /><span><?= $t ?></span></label>
        <?php } ?>
      </div>
    </fieldset>
    <label class="field">
      <span>제목</span>
      <input type="text" name="title" maxlength="200" value="<?= $isEdit ? e($notice->title) : "" ?>" required />
    </label>
    <label class="field">
      <span>공지일자</span>
      <input type="date" name="date" value="<?= $isEdit ? e($notice->date) : date("Y-m-d") ?>" required />
    </label>
    <div class="form-actions">
      <a href="./noticeLists.php" class="btn btn-line">취소</a>
      <button type="submit" class="btn btn-primary"><?= $isEdit ? "수정완료" : "추가완료" ?></button>
    </div>
  </form>
</main>

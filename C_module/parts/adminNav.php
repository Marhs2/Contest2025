<?php // 관리자 하위 메뉴 탭 ($adminTab: notice | item | user) ?>
<nav class="admin-tabs" aria-label="관리자 메뉴">
  <a href="./noticeLists.php" class="<?= $adminTab === "notice" ? "active" : "" ?>">공지사항관리</a>
  <a href="./itemList.php" class="<?= $adminTab === "item" ? "active" : "" ?>">판매상품관리</a>
  <a href="./userLists.php" class="<?= $adminTab === "user" ? "active" : "" ?>">회원관리</a>
</nav>

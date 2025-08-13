<?php
require_once "../db.php";
require_once "../lib.php";



$idx = $_GET["idx"];


DB::exec("delete from notice WHERE idx = '$idx'");

alert("삭제했습니다");

echo "<script>location.href='../'</script>";

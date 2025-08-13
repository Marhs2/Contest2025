<?php
require_once "../db.php";
require_once "../lib.php";



$idx = $_POST["idx"];
$title = $_POST["title"];
$des = $_POST["des"];
$price = $_POST["price"];

DB::exec("UPDATE notice SET type='$title',title='$des',date='$price' WHERE idx = '$idx'");

alert("수정했습니다");

echo "<script>location.href='../'</script>";

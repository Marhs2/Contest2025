<?php
require_once "../db.php";
require_once "../lib.php";



$title = $_POST["title"];
$des = $_POST["des"];
$price = $_POST["price"];

DB::exec("INSERT INTO notice(type, title, date) VALUES ('$title','$des','$price')");

alert("추가했습니다");

echo "<script>location.href='../'</script>";

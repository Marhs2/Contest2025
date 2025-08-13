<?php
require_once "db.php";



$items = file_get_contents("data.json");

$json = json_decode($items);
foreach ($json as $key => $value) {
  foreach ($value as $key2 => $value2) {
    $num = $key2 + 1;
    DB::exec("INSERT INTO item(img, cate, price, des, title, dis) VALUES ('./asaset/A-Module/images/$key/$num.PNG','$key','$value2->dis','$value2->des','$value2->title','$value2->price')");;
  }
}

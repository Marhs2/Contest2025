<?php

require_once "db.php";






$type = $_GET["type"];
$order = $_GET["order"];



if ($type == "일반") {
  echo json_encode(DB::fetchAll("select * from notice  where type = '$type'order by date $order"));
} else if ($type == "이벤트") {
  echo json_encode(DB::fetchAll("select * from notice  where type = '$type'order by date $order"));
} else {
  echo json_encode(DB::fetchAll("select * from notice  order by date $order"));
}

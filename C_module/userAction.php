<?php


require_once "db.php";
require_once "lib.php";


$type = $_POST["type"];



if ($type == "reg") {
  $id = $_POST["id"];
  $name = $_POST["name"];
  $psw = $_POST["psw"];
  $email = $_POST["email"];

  if (DB::fetch("select * from user where id = '$id'")) {
    alert("이미 사용중인 아이디입니다");
  } else {
    [$salt, $h_psw] = hashPsw($psw);
    DB::exec("INSERT INTO user( name, id, psw, salt, email) VALUES ('$name','$id','$h_psw','$salt','$email')");
    alert("회원가입 성공");
  }
  move();
} else {
  $id = $_POST["id"];
  $psw = $_POST["psw"];

  if (!DB::fetch("select * from user where id = '$id'")) {
    alert("존재하지 않는 사용자입니다");
  } else {

    $user = DB::fetch("select * from user where id = '$id'");

    $h_psw = $user->psw;
    $salt = $user->salt;

    if ($h_psw === hash("sha256", $salt . $psw)) {

      $_SESSION["ss"] = $user;

      alert("로그인 성공");
    } else {
      alert("비밀번호가 일치하지 않습니다");
    }
  }
  move();
}

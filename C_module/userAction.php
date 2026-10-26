<?php
// 로그인 / 회원가입 처리
require_once "lib.php";

$type = $_POST["type"] ?? "";
$id = trim($_POST["id"] ?? "");
$psw = $_POST["psw"] ?? "";
$back = $_SERVER["HTTP_REFERER"] ?? "./index.php";

if ($type === "reg") {
  $name = trim($_POST["name"] ?? "");
  $email = trim($_POST["email"] ?? "");

  // 4가지 필수 항목 확인
  if ($id === "" || $psw === "" || $name === "" || $email === "") {
    alertMove("아이디, 비밀번호, 이름, 이메일을 모두 입력해주세요.", $back);
  }
  if (!preg_match('/^[A-Za-z0-9_]{3,20}$/', $id)) {
    alertMove("아이디는 영문, 숫자, _ 로 3~20자 입력해주세요.", $back);
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    alertMove("이메일 형식이 올바르지 않습니다.", $back);
  }
  if (DB::fetch("SELECT idx FROM user WHERE id = ?", [$id])) {
    alertMove("이미 사용중인 아이디입니다.", $back);
  }

  // SHA256 + salt 암호화 후 가입일시와 함께 저장
  $salt = bin2hex(random_bytes(32));
  $hash = hash("sha256", $salt . $psw);
  DB::exec(
    "INSERT INTO user (id, name, email, salt, psw, regDate) VALUES (?, ?, ?, ?, ?, NOW())",
    [$id, $name, $email, $salt, $hash]
  );

  // 가입 즉시 로그인 상태로 전환
  session_regenerate_id(true);
  $_SESSION["user"] = ["id" => $id, "name" => $name, "isAd" => 0];
  alertMove("회원가입이 완료되었습니다. {$name}님 환영합니다!", $back);
}

if ($type === "login") {
  $user = DB::fetch("SELECT * FROM user WHERE id = ?", [$id]);

  // 아이디 존재 여부를 노출하지 않도록 같은 메시지 사용
  if (!$user || !hash_equals($user->psw, hash("sha256", $user->salt . $psw))) {
    alertMove("아이디 또는 비밀번호가 올바르지 않습니다.", $back);
  }

  session_regenerate_id(true);
  $_SESSION["user"] = ["id" => $user->id, "name" => $user->name, "isAd" => (int)$user->isAd];
  alertMove("{$user->name}님 반갑습니다.", $back);
}

alertMove("잘못된 요청입니다.");

<?php
// 세션 시작과 데이터베이스 연결

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

class DB
{
  static $db = null;

  // PDO 연결 (최초 1회만 생성)
  static function conn()
  {
    self::$db ??= new PDO(
      "mysql:host=localhost;dbname=cmodule;charset=utf8mb4",
      "root",
      "",
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
      ]
    );
    return self::$db;
  }

  // 값은 항상 ? 자리표시자로 넘겨 SQL 인젝션을 막는다
  static function run($sql, $params = [])
  {
    $stmt = self::conn()->prepare($sql);
    $stmt->execute($params);
    return $stmt;
  }

  static function fetch($sql, $params = [])
  {
    return self::run($sql, $params)->fetch() ?: null;
  }

  static function fetchAll($sql, $params = [])
  {
    return self::run($sql, $params)->fetchAll();
  }

  static function exec($sql, $params = [])
  {
    return self::run($sql, $params)->rowCount();
  }
}

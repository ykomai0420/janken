<?php

class Session {
  private static $instance;
  private $isStart;
  private $sessionName;

  public static function &getInstance($name = "PHPSESSID") {
    if (!isset(self::$instance)) {
      self::$instance = new self($name);
    }
    return self::$instance;
  }

  private function start() {
    if (!$this->isStart) {
      session_name($this->sessionName);
      $this->isStart = session_start();
    }
  }

  public function destroy() {
    if ($this->isStart) {
      $_SESSION = [];
      $this->isStart = !session_destroy();
      // クッキーの削除
      if (isset($_COOKIE[$this->sessionName])) {
        // 現在時間から前の時間にするとクッキーを削除できる
        setcookie($this->sessionName, '', time() - 1800);
      }
    }
  }

  private function __construct($name = "PHPSESSID") {
    $this->sessionName = $name;
    $this->start();
  }

  /**
   * セッション連想配列の取得設定されていない場合はnull
   * @param mixed $name
   * @return NULL|mixed
   */

  public function __get($name) {
    return $_SESSION[$name] ?? null;
  }

  /**
   * セッション連想配列が設定されているかチェックする
   * @param mixed $name
   * @return mixed
   */

  public function __isset($name) {
    return isset($_SESSION[$name]);
  }

  /**
   * セッションの設定
   * @param mixed $name
   * @param mixed $obj
   */

  public function __set($name, $obj) {
    $_SESSION[$name] = $obj;
  }

  /**
   * セッションのアンセット
   * @param string $name
   */

  public function __unset($name) {
    unset($_SESSION[$name]);
  }
}
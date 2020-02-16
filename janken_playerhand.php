<?php

class PlayerHand {
  private $hand;

  public function __construct() {
    $this->hand = $_POST['hand'];
  }

  public function __get($name) {
    if (method_exists($this, 'get' . $name)) {
      return $this->{'get'. $name}();
    } else if (isset($this->{$name})) {
      return $this->{$name};
    }
  }

  public function __set($name, $value) {
    if (isset($this->{$name})) {
      $this->{$name} = $value;
    }
  }

  public function getHand() {
    return $this->hand;
  }

  public function start() {
    $fileName = '';
    if (isset($_POST['hand'])) {
      switch ($this->getHand()) {
        case 0:
          return './doc/janken_gu.png';
          break;
        case 1:
          return './doc/janken_choki.png';
          break;
        case 2:
          return './doc/janken_pa.png';
          break; 
      }
    }
  }
}
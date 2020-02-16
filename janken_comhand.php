<?php
require_once 'janken_playerHand.php';

class ComHand extends PlayerHand {
  private $hand;

  public function __construct() {
    $this->hand = mt_rand(0, 2);
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
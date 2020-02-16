<?php
require_once 'janken_playerHand.php';
require_once 'janken_comHand.php';
require_once 'session.php';
require_once 'MySmarty.class.php';


class Logic {
  private $winCount;
  private $drawCount;
  private $loseCount;
  private $player;
  private $com;
  private $session;
  public $ply;
  public $comp;
  public $rst;
  public $win;
  public $lose;
  public $draw;
  public $dest;


  public function __construct(int $winCount = 0, int $drawCount = 0, int $loseCount = 0) {
    $this->winCount = $winCount;
    $this->drawCount = $drawCount;
    $this->loseCount = $loseCount;
    $this->player = new PlayerHand();
    $this->com = new ComHand();
    $this->session = Session::getInstance();
  }

  public function __get($name) {
    if (isset($this->{$name})) {
      return $this->{$name};
    }
  }

  public function __set($name, $value) {
    if (isset($this->name)) {
      $this->{name} = $value;
    }
  }

  public function playerStart() {
    $this->ply = $this->player->start();
  }

  public function comStart() {
    $this->comp = $this->com->start();
  }



  public function playBattle() {
    // プレイヤーの手 - コンピューターの手 + 3 % 3
    $result = ($this->player->getHand() - $this->com->getHand() + 3) % 3;
    if (isset($_POST['hand'])) {
      switch ($result) {
        case 0:
          $this->drawCount = ++$this->session->drawCount;
          $this->rst = '引き分け';
          break;
        case 1:
          $this->loseCount = ++$this->session->loseCount;
          $this->rst = '負け';
          break;
        case 2:
          $this->winCount = ++$this->session->winCount;
          $this->rst = '勝ち';
          break;
      }
    }
  }

  public function result() {
      $this->win = $this->session->winCount;
      $this->lose = $this->session->loseCount;
      $this->draw = $this->session->drawCount;
  }

  public function destroy() {
    if (!empty($_POST['reset'])) {
      $this->dest = $this->session->destroy();
    }
  }
}

$cls = new Logic();
$cls->playerStart();
$cls->comStart();
$cls->playBattle();
$cls->result();
$cls->destroy();
$smarty = new MySmarty();
$smarty->assign('player', $cls->ply);
$smarty->assign('com', $cls->comp);
$smarty->assign('result', $cls->rst);
$smarty->assign('win', $cls->win);
$smarty->assign('lose', $cls->lose);
$smarty->assign('draw', $cls->draw);
$smarty->assign('dest', $cls->dest);
$smarty->display('janken_result_view.tpl');
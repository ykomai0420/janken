<?php
require_once '../vendor/autoload.php';

class MySmarty extends Smarty {
  public function __construct() {
    // 基底クラスのコンストラクタを実行
    parent::__construct();
    // パラメータ設定
    $this->template_dir = './templates';
    $this->compile_dir = './templates_c';
  }
}
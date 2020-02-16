<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>じゃんけんゲーム</title>
    <link rel="stylesheet" href="janken_result_view.css">
  </head>
  <body>
    <h1>じゃんけんゲーム</h1>
    <h2>結果</h2>
    <p>あなた：<img src="{$player}"></p>
    <p>相手：<img src="{$com}"></p>
    <p>{$result}</p>
    <div>
    <p>{$win}勝</p>
    <p>{$lose}敗</p>
    <p>{$draw}分</p>
    <form method="POST" action="janken_play_view.html">
      <span><input type="submit" name="retry" value="もう一度"></span>
    </form>
    <form method="POST">
      <span><input type="submit" name="reset" value="リセット"></span>
    </form>
    {$dest}
    <a href="http://localhost/selfphp/janken/janken_start_view.html">スタート画面へ</a>
    </div>
  </body>
</html>
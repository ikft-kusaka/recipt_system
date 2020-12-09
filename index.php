<?php
session_start();
require('./common/dbconnect.php');
require_once('./common/session_check.php');

generalCheck($_SESSION['general'], $_SESSION['admin']);

// フォームが送信された場合
if (!empty($_POST)) {
  $today = date("Y-m-d H:i:s");
  if ($_POST['settle-date'] > $today) {
    $error['settle-date'] = 'greater';
  }
  if ($_POST['settle-date'] === '') {
    $error['settle-date'] = 'blank';
  }
}

?>
<!DOCTYPE html>
<html lang="jp">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>領収書入力システム</title>
  <link rel="stylesheet" href="modern_css_reset.css" />
  <link rel="stylesheet" href="index.css" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <h1 class="page-title">領収書入力</h1>
    </div>
  </header>
  <main class="main">
    <div class="main__container">
      <form action="" method="post">
        <div class="main__top">
          <div class="main__top-left">
            <div class="topics__top">
              <div class="topic">
                <span class="topic-name class">区分</span>
                <select name="class" class="input--normal">
                  <option value="0">相殺</option>
                  <option value="1">一括</option>
                  <option value="2" selected>分割</option>
                </select>
              </div>
              <div class="topic">
                <span class="topic-name settle-date">領収日</span>
                <input class="input input--normal" type="date" name="date" />
              </div>
              <?php if ($error['settle-date'] === 'greater') : ?>
                <p class="error">※本日より前の日付を入力してください。</p>
              <?php endif ?>
              <?php if ($error['settle-date'] === 'blank') : ?>
                <p class="error">※日付を指定してください。</p>
              <?php endif ?>
            </div>
          </div>
          <div class="main__top-right">
            <div class="information">
              <p class="corporation-name">稲畑ファインテック(株)</p>
              <div class="user__information">
                <span class="topic-name employee-number">0000</span>
                <span class="topic-name employee-name">稲畑ファインテック</span>
              </div>
            </div>
            <!-- <input type="button" value="閉じる【F7】" /> -->
          </div>
        </div>
        <div class="main__bottom">
          <div class="topic">
            <span class="topic-name tax-rate">税率</span>
            <select name="tax-rate" class="input--normal">
              <option value="0">10.0%</option>
              <option value="1">8.0%(軽減税率)</option>
              <option value="2">5.0%</option>
            </select>
          </div>
          <div class="topic">
            <span class="topic-name custormer">得意先</span>
          </div>
          <div class="topic">
            <span class="topic-name recipt-amount">領収金額</span>
            <input type="text" name="recipt-amount" class="input--normal" />
          </div>
        </div>
        <table class="recipt__table" border="5" width="500" height="300">
          <tr class="recipt__table__topic">
            <th class="recipt__table__title"></th>
            <th class="recipt__table__title">領収金額</th>
            <th class="recipt__table__title">消費税等</th>
          </tr>
          <tr class="table__row">
            <td class="row-number">1</td>
            <td></td>
            <td></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">2</td>
            <td></td>
            <td></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">3</td>
            <td></td>
            <td></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">4</td>
            <td></td>
            <td></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">5</td>
            <td></td>
            <td></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">6</td>
            <td></td>
            <td></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">7</td>
            <td></td>
            <td></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">8</td>
            <td></td>
            <td></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">9</td>
            <td></td>
            <td></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">10</td>
            <td></td>
            <td></td>
          </tr>
        </table>
        <input type="submit" value="入力内容を確認する">
      </form>
    </div>
  </main>
</body>

</html>
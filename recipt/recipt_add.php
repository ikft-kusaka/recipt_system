<?php
session_start();
require('../common/dbconnect.php');
require_once('../common/session_check.php');

generalCheck($_SESSION['general'], $_SESSION['admin']);

// フォームが送信された場合
if (!empty($_POST)) {
  $today = date("Y-m-d H:i:s");
  if ($_POST['recipt-date'] > $today) {
    $error['recipt-date'] = 'greater';
  }
  if ($_POST['recipt-date'] === '') {
    $error['recipt-date'] = 'blank';
  }
}

?>
<!DOCTYPE html>
<html lang="jp">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>領収書入力システム</title>
  <link rel="stylesheet" href="../stylesheet/modern_css_reset.css" />
  <link rel="stylesheet" href="../stylesheet/recipt.css" />
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
                <span class="topic-name classification">区分</span>
                <select name="classification" class="input--normal">
                  <option value="0">相殺</option>
                  <option value="1">一括</option>
                  <option value="2" selected>分割</option>
                </select>
              </div>
              <div class="topic">
                <span class="topic-name recipt-date">領収日</span>
                <input class="input input--normal" type="date" name="recipt-date" />
              </div>
              <?php if ($error['recipt-date'] === 'greater') : ?>
                <p class="error">※本日より前の日付を入力してください。</p>
              <?php endif ?>
              <?php if ($error['recipt-date'] === 'blank') : ?>
                <p class="error">※日付を指定してください。</p>
              <?php endif ?>
            </div>
          </div>
          <div class="main__top-right">
            <div class="information">
              <p class="corporation-name">稲畑ファインテック(株)</p>
              <div class="user__information">
                <?php if (!empty($_SESSION['admin'])) : ?>
                  <span class="topic-name employee-number"><?php echo htmlspecialchars($_SESSION['admin']['employee_number']) ?></span>
                  <span class="topic-name employee-name"> <?php echo htmlspecialchars($_SESSION['admin']['first_name'], ENT_QUOTES) ?> <?php echo htmlspecialchars($_SESSION['admin']['last_name'], ENT_QUOTES) ?></span>
                <?php else : ?>
                  <span class="topic-name employee-number"><?php echo htmlspecialchars($_SESSION['general']['employee_number']) ?></span>
                  <span class="topic-name employee-name"> <?php echo htmlspecialchars($_SESSION['general']['first_name'], ENT_QUOTES) ?> <?php echo htmlspecialchars($_SESSION['general']['last_name'], ENT_QUOTES) ?></span>
                <?php endif ?>
              </div>
            </div>
            <!-- <input type="button" value="閉じる【F7】" /> -->
          </div>
        </div>
        <div class="main__bottom">
          <div class="topic">
            <span class="topic-name tax-rate">税率</span>
            <select name="tax-rate" class="tax-rate input--normal" id="tax-rate">
              <option value="0" selected>10.0%</option>
              <option value="1">8.0%(軽減税率)</option>
            </select>
          </div>
          <div class="topic">
            <span class="topic-name customer">得意先</span>
            <input type="text" class="customer" name="customer-code">
            <input type="submit" name="customer-jump" value="…">
          </div>
          <div class="topic">
            <span class="topic-name recipt-amount">領収金額</span>
            <input type="number" name="recipt-amount" class="input--normal" id="recipt-amount" />
            <button type="" class="recipt__btn" id="recipt-btn">挿入</button>
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
            <td class="recipt-amount-cell" name="recipt-amount-cell1"></td>
            <td class="implement-tax-cell" name="implement-tax-cell1"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">2</td>
            <td class="recipt-amount-cell" name="recipt-amount-cell2"></td>
            <td class="implement-tax-cell" name="implement-tax-cell2"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">3</td>
            <td class="recipt-amount-cell" name="recipt-amount-cell3"></td>
            <td class="implement-tax-cell" name="implement-tax-cell3"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">4</td>
            <td class="recipt-amount-cell" name="recipt-amount-cell4"></td>
            <td class="implement-tax-cell" name="implement-tax-cell4"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">5</td>
            <td class="recipt-amount-cell" name="recipt-amount-cell5"></td>
            <td class="implement-tax-cell" name="implement-tax-cell5"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">6</td>
            <td class="recipt-amount-cell" name="recipt-amount-cell6"></td>
            <td class="implement-tax-cell" name="implement-tax-cell6"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">7</td>
            <td class="recipt-amount-cell" name="recipt-amount-cell7"></td>
            <td class="implement-tax-cell" name="implement-tax-cell7"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">8</td>
            <td class="recipt-amount-cell" name="recipt-amount-cell8"></td>
            <td class="implement-tax-cell" name="implement-tax-cell8"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">9</td>
            <td class="recipt-amount-cell" name="recipt-amount-cell9"></td>
            <td class="implement-tax-cell" name="implement-tax-cell9"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">10</td>
            <td class="recipt-amount-cell" name="recipt-amount-cell10"></td>
            <td class="implement-tax-cell" name="implement-tax-cell10"></td>
          </tr>
        </table>
        <input type="submit" value="入力内容を確認する">
      </form>
    </div>
  </main>
  <script src="../javascript/recipt.js"></script>
</body>

</html>
<?php
session_start();
require('../common/dbconnect.php');
require_once('../common/session_check.php');

generalCheck($_SESSION['general'], $_SESSION['admin']);

if (!empty($_SESSION['admin'])) {
  $userId = $_SESSION['admin']['employee_number'];
  $userName .= $_SESSION['admin']['first_name'];
  $userName .= $_SESSION['admin']['last_name'];
} else {
  $userId = $_SESSION['general']['employee_number'];
  $userName .= $_SESSION['general']['first_name'];
  $userName .= $_SESSION['general']['last_name'];
}

var_dump($userId, $userName);

// フォームが送信された場合
if (!empty($_POST)) {
  $stmt = $db->prepare(
    "INSERT INTO recipt SET 
    classification=?, recipt_date=?, tax_rate=?, 
    customer_code=?, total_recipt_amount=?, recipt_amount1=?,
    comsumpition_tax1=?, stamp_duty1='0', cancel_classification='0',
    user_id=?, created_at=NOW(), creator=?,
    updated_at=NOW(), updater=?");
  $stmt->execute(array(
    $_SESSION['recipt-add']['classification'],
    $_SESSION['recipt-add']['recipt-date'],
    $_SESSION['recipt-add']['tax-rate'],
    $_SESSION['recipt-add']['customer-code'],
    $_SESSION['recipt-add']['total-recipt-amount'],
    $_SESSION['recipt-add']['recipt-amount-cell1'],
    $_SESSION['recipt-add']['comsumpition-tax-cell1'],
    $userId,
    $userName,
    $userName,
  ));
}

?>
<!DOCTYPE html>
<html lang="jp">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>領収書入力システムチェック</title>
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
        <input type="hidden" >
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
        <input type="submit" value="DB登録">
      </form>
    </div>
  </main>
  <!-- <script src="../javascript/recipt.js"></script> -->
</body>

</html>
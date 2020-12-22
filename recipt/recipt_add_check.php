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
    customer_code=?, total_recipt_amount=?, 
    recipt_amount1=?, comsumpition_tax1=?, stamp_duty1='0',
    recipt_amount2=?, comsumpition_tax2=?, stamp_duty2='0',
    recipt_amount3=?, comsumpition_tax3=?, stamp_duty3='0',
    recipt_amount4=?, comsumpition_tax4=?, stamp_duty4='0',
    recipt_amount5=?, comsumpition_tax5=?, stamp_duty5='0',
    recipt_amount6=?, comsumpition_tax6=?, stamp_duty6='0',
    recipt_amount7=?, comsumpition_tax7=?, stamp_duty7='0',
    recipt_amount8=?, comsumpition_tax8=?, stamp_duty8='0',
    recipt_amount9=?, comsumpition_tax9=?, stamp_duty9='0',
    recipt_amount10=?, comsumpition_tax10=?, stamp_duty10='0',
    cancel_classification='0',
    user_id=?, created_at=NOW(), creator=?,
    updated_at=NOW(), updater=?");
  $stmt->execute(array(
    $_SESSION['recipt-add']['classification'],
    $_SESSION['recipt-add']['recipt-date'],
    $_SESSION['recipt-add']['tax-rate'],
    $_SESSION['recipt-add']['customer-code'],
    $_SESSION['recipt-add']['total-recipt-amount'],
    $_SESSION['recipt-add']['recipt-amount1'],
    $_SESSION['recipt-add']['comsumpition-tax1'],
    $_SESSION['recipt-add']['recipt-amount2'],
    $_SESSION['recipt-add']['comsumpition-tax2'],
    $_SESSION['recipt-add']['recipt-amount3'],
    $_SESSION['recipt-add']['comsumpition-tax3'],
    $_SESSION['recipt-add']['recipt-amount4'],
    $_SESSION['recipt-add']['comsumpition-tax4'],
    $_SESSION['recipt-add']['recipt-amount5'],
    $_SESSION['recipt-add']['comsumpition-tax5'],
    $_SESSION['recipt-add']['recipt-amount6'],
    $_SESSION['recipt-add']['comsumpition-tax6'],
    $_SESSION['recipt-add']['recipt-amount7'],
    $_SESSION['recipt-add']['comsumpition-tax7'],
    $_SESSION['recipt-add']['recipt-amount8'],
    $_SESSION['recipt-add']['comsumpition-tax8'],
    $_SESSION['recipt-add']['recipt-amount9'],
    $_SESSION['recipt-add']['comsumpition-tax9'],
    $_SESSION['recipt-add']['recipt-amount10'],
    $_SESSION['recipt-add']['comsumpition-tax10'],
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
            <span class="topic-name">領収金額</span>
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
            <td class="recipt-amount" name="recipt-amount1"></td>
            <td class="implement-tax" name="implement-tax1"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">2</td>
            <td class="recipt-amount" name="recipt-amount2"></td>
            <td class="implement-tax" name="implement-tax2"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">3</td>
            <td class="recipt-amount" name="recipt-amount3"></td>
            <td class="implement-tax" name="implement-tax3"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">4</td>
            <td class="recipt-amount" name="recipt-amount4"></td>
            <td class="implement-tax" name="implement-tax4"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">5</td>
            <td class="recipt-amount" name="recipt-amount5"></td>
            <td class="implement-tax" name="implement-tax5"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">6</td>
            <td class="recipt-amount" name="recipt-amount6"></td>
            <td class="implement-tax" name="implement-tax6"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">7</td>
            <td class="recipt-amount" name="recipt-amount7"></td>
            <td class="implement-tax" name="implement-tax7"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">8</td>
            <td class="recipt-amount" name="recipt-amount8"></td>
            <td class="implement-tax" name="implement-tax8"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">9</td>
            <td class="recipt-amount" name="recipt-amount9"></td>
            <td class="implement-tax" name="implement-tax9"></td>
          </tr>
          <tr class="table__row">
            <td class="row-number">10</td>
            <td class="recipt-amount" name="recipt-amount10"></td>
            <td class="implement-tax" name="implement-tax10"></td>
          </tr>
        </table>
        <input type="submit" value="DB登録">
      </form>
    </div>
  </main>
  <!-- <script src="../javascript/recipt.js"></script> -->
</body>

</html>
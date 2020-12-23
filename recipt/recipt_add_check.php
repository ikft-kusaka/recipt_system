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

// フォームが送信された場合
if (!empty($_POST)) {
  if (!empty($_SESSION['recipt-add'])) {
    // reciptテーブルに領収書データを登録
    $stmt = $db->prepare(
      "INSERT INTO recipt SET 
    classification=?, recipt_date=?, tax_rate=?, 
    customer_code=?, total_recipt_amount=?, 
    recipt_amount1=?, comsumpition_tax1=?, stamp_duty1=?,
    recipt_amount2=?, comsumpition_tax2=?, stamp_duty2=?,
    recipt_amount3=?, comsumpition_tax3=?, stamp_duty3=?,
    recipt_amount4=?, comsumpition_tax4=?, stamp_duty4=?,
    recipt_amount5=?, comsumpition_tax5=?, stamp_duty5=?,
    recipt_amount6=?, comsumpition_tax6=?, stamp_duty6=?,
    recipt_amount7=?, comsumpition_tax7=?, stamp_duty7=?,
    recipt_amount8=?, comsumpition_tax8=?, stamp_duty8=?,
    recipt_amount9=?, comsumpition_tax9=?, stamp_duty9=?,
    recipt_amount10=?, comsumpition_tax10=?, stamp_duty10=?,
    cancel_classification='1',
    user_id=?, created_at=NOW(), creator=?,
    updated_at=NOW(), updater=?"
    );

    $stmt->execute(array(
      $_SESSION['recipt-add']['classification'],
      $_SESSION['recipt-add']['recipt-date'],
      $_SESSION['recipt-add']['tax-rate'],
      $_SESSION['recipt-add']['customer-code'],
      $_SESSION['recipt-add']['total-recipt-amount'],
      $_SESSION['recipt-add']['recipt-amount1'],
      $_SESSION['recipt-add']['comsumpition-tax1'],
      $_SESSION['recipt-add']['stamp-duty1'],
      $_SESSION['recipt-add']['recipt-amount2'],
      $_SESSION['recipt-add']['comsumpition-tax2'],
      $_SESSION['recipt-add']['stamp-duty2'],
      $_SESSION['recipt-add']['recipt-amount3'],
      $_SESSION['recipt-add']['comsumpition-tax3'],
      $_SESSION['recipt-add']['stamp-duty3'],
      $_SESSION['recipt-add']['recipt-amount4'],
      $_SESSION['recipt-add']['comsumpition-tax4'],
      $_SESSION['recipt-add']['stamp-duty4'],
      $_SESSION['recipt-add']['recipt-amount5'],
      $_SESSION['recipt-add']['comsumpition-tax5'],
      $_SESSION['recipt-add']['stamp-duty5'],
      $_SESSION['recipt-add']['recipt-amount6'],
      $_SESSION['recipt-add']['comsumpition-tax6'],
      $_SESSION['recipt-add']['stamp-duty6'],
      $_SESSION['recipt-add']['recipt-amount7'],
      $_SESSION['recipt-add']['comsumpition-tax7'],
      $_SESSION['recipt-add']['stamp-duty7'],
      $_SESSION['recipt-add']['recipt-amount8'],
      $_SESSION['recipt-add']['comsumpition-tax8'],
      $_SESSION['recipt-add']['stamp-duty8'],
      $_SESSION['recipt-add']['recipt-amount9'],
      $_SESSION['recipt-add']['comsumpition-tax9'],
      $_SESSION['recipt-add']['stamp-duty9'],
      $_SESSION['recipt-add']['recipt-amount10'],
      $_SESSION['recipt-add']['comsumpition-tax10'],
      $_SESSION['recipt-add']['stamp-duty10'],
      $userId,
      $userName,
      $userName,
    ));
    // ユーザー追加の際に使用したセッションを破棄する
    unset($_SESSION['recipt-add']);
    header('Location: ../general/general_menu.php');
    exit();
  }
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
    <h3 class="check-msg">以下の内容で登録致します。</h3>
    <div class="main__container">
      <form action="" method="post">
        <input type="hidden" action="" value="submit" name="submit">
        <div class="main__top">
          <div class="main__top-left">
            <div class="topics__top">
              <div class="topic">
                <span class="topic-name classification">区分</span>
                <span class="classification"><?php echo (htmlspecialchars($_SESSION['recipt-add']['classification'])) ?></span>
              </div>
              <div class="topic">
                <span class="topic-name recipt-date">領収日</span>
                <span class="recipt-date"><?php echo (htmlspecialchars($_SESSION['recipt-add']['recipt-date'])) ?></span>
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
            <span class="tax-rate"><?php echo (htmlspecialchars($_SESSION['recipt-add']['tax-rate'])) ?></span>
          </div>
          <div class="topic">
            <span class="topic-name customer">得意先</span>
            <span class="cutomer-code"><?php echo (htmlspecialchars($_SESSION['recipt-add']['customer-code'])) ?></span>
          </div>
        </div>
        <table class="recipt__table" border="5" width="500" height="300">
          <tr class="recipt__table__topic">
            <th class="recipt__table__title"></th>
            <th class="recipt__table__title">領収金額</th>
            <th class="recipt__table__title">消費税等</th>
          </tr>
          <!-- 領収データ1~10まで表を作成 -->
          <?php for ($i = 1; $i <= 10; $i++) : ?>
            <tr class="table__row">
              <td class="row-number"><?php echo $i ?></td>
              <td class="recipt-amount"><?php echo (htmlspecialchars($_SESSION['recipt-add']["recipt-amount$i"])) ?></td>
              <td class="comsumpition-tax"><?php echo (htmlspecialchars($_SESSION['recipt-add']["comsumpition-tax$i"])) ?></td>
            </tr>
          <?php endfor ?>
        </table>
        <input type="submit" value="登録">
      </form>
    </div>
  </main>
</body>

</html>
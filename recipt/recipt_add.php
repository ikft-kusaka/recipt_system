<?php
session_start();
require('../common/dbconnect.php');
require_once('../common/session_check.php');
require_once('../common/error_check.php');

generalCheck($_SESSION['general'], $_SESSION['admin']);

// フォームが送信された場合
if (!empty($_POST)) {
  $error = reciptAddErrorCheck($_POST);
  if (empty($error)) {
    $_SESSION['recipt-add'] = $_POST;
    header('Location: recipt_add_check.php');
    exit();
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
                <select name="classification" class="input--normal" id="classification" value="<?php echo (htmlspecialchars($_POST['classification'])) ?>">
                  <option value="0">相殺</option>
                  <option value="1">一括</option>
                  <option value="2" selected>分割</option>
                </select>
              </div>
              <div class="topic">
                <span class="topic-name recipt-date">領収日</span>
                <input class="input input--normal" type="date" name="recipt-date" value="<?php echo (htmlspecialchars($_POST['recipt-date'])) ?>" />
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
          </div>
        </div>
        <div class="main__bottom">
          <div class="topic">
            <span class="topic-name tax-rate">税率</span>
            <select name="tax-rate" class="tax-rate input--normal" id="tax-rate" value="<?php echo (htmlspecialchars($_POST['tax-rate'])) ?>">
              <option value="0" selected>10.0%</option>
              <option value="1">8.0%(軽減税率)</option>
            </select>
          </div>
          <?php if ($error['customer-code'] === 'blank') : ?>
            <p class="error">※得意先を指定してください</p>
          <?php endif ?>
          <div class="topic">
            <span class="topic-name customer">得意先</span>
            <input type="text" class="customer" name="customer-code" value="<?php echo (htmlspecialchars($_POST['customer-code'])) ?>">
            <input type="submit" name="customer-jump" value="…">
          </div>
          <div class="topic">
            <span class="topic-name">領収金額</span>
            <input type="number" name="recipt-amount" class="input--normal" id="recipt-amount" />
            <button type="" class="recipt__btn" id="recipt-btn">挿入</button>
          </div>
          <?php if ($error['recipt-amount'] === 'blank') : ?>
            <p class="error">※領収金額は1円以上の額を登録してください。</p>
          <?php endif ?>
          <?php if ($error['recipt-amount'] === 'none') : ?>
            <p class="error">※1件以上領収データを入力してください。</p>
          <?php endif ?>
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
            <input type="hidden" class="stamp-duty" name="<?php echo "stamp-duty$i" ?>">
            <td><input class="recipt-amount" type="number" name="<?php echo "recipt-amount$i" ?>" readonly></td>
            <td><input class="comsumpition-tax" type="number" name="<?php echo "comsumpition-tax$i" ?>" readonly></td>
          </tr>
          <?php endfor ?>
        </table>
        <input type="hidden" id="total-recipt-amount" name="total-recipt-amount">
        <input type="hidden" id="total-stamp-duty" name="total-stamp-duty">
        <input type="submit" value="入力内容を確認する" id="recipt-add-btn">
      </form>
    </div>
  </main>
  <script src="../javascript/recipt.js"></script>
</body>

</html>
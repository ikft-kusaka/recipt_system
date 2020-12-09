<?php
session_start();
require_once('../common/dbconnect.php');
require_once('../common/session_check.php');
require_once('../common/error_check.php');

adminCheck($_SESSION['admin']);

// 入力チェック
if (!empty($_POST)) {
    $error = userEditCheck($_POST);
    if (empty($error)) {
        // 登録ボタンを押下した場合、確認画面へ遷移
        if (!empty($_POST['action'])) {
            // 入力内容を上書き
            $_SESSION['user-edit'] = $_POST;
            header('Location: user_edit_check.php');
            exit();
        }
    }
}

$stmt = $db->prepare('SELECT * FROM user_mst WHERE id=?');
$stmt->execute(array($_SESSION['user-edit']['id']));
$rec = $stmt->fetch();

?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="../modern_css_reset.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="page-title">ユーザー編集</h1>
        </div>
    </header>
    <main class="main">
        <div class="main__container">
            <form action="" method="post">
                <input type="hidden" name="action" value="submit">
                <input type="hidden" name="user-id" value="<?php echo (htmlspecialchars($rec['id'])) ?>>
                <div class=" user-name__area">
                <span class="user-name">姓名</span>
                <input type="text" class="user-first-name__input" name="user-first-name" value="<?php echo (htmlspecialchars($rec['first_name'])) ?>" />
                <input type="text" class="user-last-name__input" name="user-last-name" value="<?php echo (htmlspecialchars($rec['last_name'])) ?>" />
                <?php if ($error['user-name'] === 'blank') : ?>
                    <p class="error-msg">*姓名を入力してください。</p>
                <?php endif ?>
        </div>
        <div class="user-email__area">
            <span class="user-email">メールアドレス</span>
            <input type="text" class="user-email__input" name="user-email" value="<?php echo (htmlspecialchars($rec['email'])) ?>" />
            <?php if ($error['user-email'] === 'blank') : ?>
                <p class="error-msg">*メールアドレスを入力してください。</p>
            <?php endif ?>
            <?php if ($error['user-email'] === 'unmatch') : ?>
                <p class="error-msg">*正しいメールアドレスを入力してください。</p>
            <?php endif ?>
        </div>
        <div class="employee-number__area">
            <span class="employee-number">社員番号</span>
            <input type="text" class="employee-number__input" name="employee-number" value="<?php echo (htmlspecialchars($rec['employee_number'])) ?>" />
            <?php if ($error['employee-number'] === 'blank') : ?>
                <p class="error-msg">社員番号を入力してください</p>
            <?php endif ?>
            <?php if ($error['employee-number'] === 'unmatch') : ?>
                <p class="error-msg">社員番号は半角数字4桁で入力してください。</p>
            <?php endif ?>
        </div>
        <div class="authority__area">
            <span class="authority">管理者権限</span>
            <select name="authority" class="authority__select">
                <option value="0" selected>標準</option>
                <option value="1">管理者</option>
            </select>
        </div>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
        <?php if ($error['authority'] === 'blank') : ?>
            <p class="error-msg">管理者</p>
        <?php endif ?>
        </form>
        </div>
        <div class="menu__btn btn">
            <a href="admin_menu.php">管理メニューへ</a>
        </div>
    </main>

</body>

</html>
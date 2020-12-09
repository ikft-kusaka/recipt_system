<?php
session_start();
require_once('../common/dbconnect.php');
require_once('../common/session_check.php');
require_once('../common/error_check.php');

adminCheck($_SESSION);

// 入力チェック
if (!empty($_POST)) {
    $error = userAddErrorCheck($_POST);
    if (empty($error)) {
        $_SESSION['user-add'] = $_POST;
        header('Location: user_add_check.php');
    }
}
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="../modern_css_reset.css">
    <link rel="stylesheet" href="staff.css">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="page-title">ユーザー追加</h1>
        </div>
    </header>
    <main class="main">
        <div class="main__container">
            <form action="" method="post">
                <div class="login__form">
                    <div class="user-name__area">
                        <span class="user-name">姓名</span>
                        <input type="text" class="user-first-name__input" name="user-first-name" value="<?php echo (htmlspecialchars($_POST['user-name'])) ?>" />
                        <input type="text" class="user-last-name__input" name="user-last-name" value="<?php echo (htmlspecialchars($_POST['user-name'])) ?>" />
                        <?php if ($error['user-name'] === 'blank') : ?>
                            <p class="error-msg">*姓名を入力してください。</p>
                        <?php endif ?>
                    </div>
                    <div class="user-email__area">
                        <span class="user-email">メールアドレス</span>
                        <input type="text" class="user-email__input" name="user-email" value="<?php echo (htmlspecialchars($_POST['user-email'])) ?>" />
                        <?php if ($error['user-email'] === 'blank') : ?>
                            <p class="error-msg">*メールアドレスを入力してください。</p>
                        <?php endif ?>
                        <?php if ($error['user-email'] === 'unmatch') : ?>
                            <p class="error-msg">*正しいメールアドレスを入力してください。</p>
                        <?php endif ?>
                    </div>
                    <div class="user-password__area">
                        <span class="user-password">パスワード</span>
                        <input type="text" class="user-password__input" name="user-password" value="<?php echo (htmlspecialchars($_POST['user-password'])) ?>" />
                        <?php if ($error['user-password'] === 'blank') : ?>
                            <p class="error-msg">パスワードを入力してください</p>
                        <?php endif ?>
                        <?php if ($error['login'] === 'different') : ?>
                            <p class="error-msg">ユーザーIDもしくはパスワードが異なります。</p>
                        <?php endif ?>
                    </div>
                    <div class="user-password__area2">
                        <span class="user-password2">パスワード確認用</span>
                        <input type="text" class="user-password2__input" name="user-password2" value="<?php echo (htmlspecialchars($_POST['user-password2'])) ?>" />
                        <?php if ($error['user-password'] === 'different') : ?>
                            <p class="error-msg">入力されたパスワードが異なります。</p>
                        <?php endif ?>
                        <?php if ($error['login'] === 'different') : ?>
                            <p class="error-msg">ユーザーIDもしくはパスワードが異なります。</p>
                        <?php endif ?>
                    </div>
                    <div class="employee-number__area">
                        <span class="employee-number">社員番号</span>
                        <input type="text" class="employee-number__input" name="employee-number" value="<?php echo (htmlspecialchars($_POST['employee-number'])) ?>" />
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
                        <?php if ($error['authority'] === 'blank') : ?>
                            <p class="error-msg">管理者</p>
                        <?php endif ?>
                    </div>
                    <input class="add_btn btn" type="submit" value="登録">
                </div>
            </form>
        </div>
        <div class="menu__btn btn">
            <a href="staff_menu.php">管理メニューへ</a>
        </div>
    </main>
</body>

</html>
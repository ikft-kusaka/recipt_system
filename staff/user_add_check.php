<?php
session_start();
require_once('../common/dbconnect.php');
require_once('../common/session_check.php');

adminCheck($_SESSION);

userAddCheck($_SESSION);

if (!empty($_POST)) {
    var_dump($_POST);
    $stmt = $db->prepare('INSERT INTO user_mst SET first_name=?, last_name=?, email=?, password=?, employee_number=?, authority=?, created_at=NOW(), updated_at=NOW()');
    $stmt->execute(array(
        $_SESSION['add']['user-first-name'],
        $_SESSION['add']['user-last-name'],
        $_SESSION['add']['user-email'],
        md5($_SESSION['add']['user-password']),
        $_SESSION['add']['employee-number'],
        $_SESSION['add']['authority'],
    ));
    // ユーザー追加の際に使用したセッションを破棄する
    unset($_SESSION['add']);
    header('Location: staff_menu.php');
    exit();
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
            <p class="confirm-msg">登録内容は以下でよろしいですか？</p>
            <form action="" method="post">
                <input type="hidden" name="action" value="submit" />
                <div class="login__form">
                    <div class="user-name__area">
                        <span class="user-name">姓名：</span>
                        <span class="user-first-name__input"><?php echo (htmlspecialchars($_SESSION['add']['user-first-name'], ENT_QUOTES)) ?></span>
                        <span class="user-last-name__input"><?php echo (htmlspecialchars($_SESSION['add']['user-last-name'], ENT_QUOTES)) ?></span>
                    </div>
                    <div class="user-email__area">
                        <span class="user-email">メールアドレス：</span>
                        <span class="user-email__input"><?php echo (htmlspecialchars($_SESSION['add']['user-email'], ENT_QUOTES)) ?></span>
                    </div>
                    <div class="user-password__area">
                        <span class="user-password">パスワード：</span>
                        <span class="user-password__input"><?php echo (htmlspecialchars($_SESSION['add']['user-password'], ENT_QUOTES)) ?></span>
                    </div>
                    <div class="employee-number__area">
                        <span class="employee-number">社員番号：</span>
                        <span class="employee-number__input"><?php echo (htmlspecialchars($_SESSION['add']['employee-number'], ENT_QUOTES)) ?></span>
                    </div>
                    <div class="authority__area">
                        <span class="authority">管理者権限：</span>
                        <span><?php echo (htmlspecialchars($_SESSION['add']['authority'], ENT_QUOTES)) ?></span>
                    </div>
                    <input class="add_btn btn" type="submit" value="登録する">
                </div>
            </form>
        </div>
    </main>
</body>

</html>
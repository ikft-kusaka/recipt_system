<?php
session_start();
require('../dbconnect.php');


// セッション変数を保持していない場合管理メニューへ
if (!isset($_SESSION['edit'])) {
    header('Location: staff_menu.php');
    exit();
}


// 更新処理
if (!empty($_POST)) {
    $stmt = $db->prepare('UPDATE user_mst SET first_name=?, last_name=?, email=?, employee_number=?, authority=?, updated_at=NOW() WHERE id=?');
    $stmt->execute(array(
        $_SESSION['edit']['user-first-name'],
        $_SESSION['edit']['user-last-name'],
        $_SESSION['edit']['user-email'],
        $_SESSION['edit']['employee-number'],
        $_SESSION['edit']['authority'],
        $_SESSION['edit']['user-id']
    ));
    // ユーザー追加の際に使用したセッションを破棄する
    unset($_SESSION['edit']);
    header('Location: staff_menu.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者</title>
    <link rel="stylesheet" href="../modern_css_reset.css">
    <link rel="stylesheet" href="staff.css">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="page-title">ユーザー編集</h1>
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
                        <span class="user-first-name__input"><?php echo (htmlspecialchars($_SESSION['edit']['user-first-name'], ENT_QUOTES)) ?></span>
                        <span class="user-last-name__input"><?php echo (htmlspecialchars($_SESSION['edit']['user-last-name'], ENT_QUOTES)) ?></span>
                    </div>
                    <div class="user-email__area">
                        <span class="user-email">メールアドレス：</span>
                        <span class="user-email__input"><?php echo (htmlspecialchars($_SESSION['edit']['user-email'], ENT_QUOTES)) ?></span>
                    </div>
                    <div class="employee-number__area">
                        <span class="employee-number">社員番号：</span>
                        <span class="employee-number__input"><?php echo (htmlspecialchars($_SESSION['edit']['employee-number'], ENT_QUOTES)) ?></span>
                    </div>
                    <div class="authority__area">
                        <span class="authority">管理者権限：</span>
                        <span><?php echo (htmlspecialchars($_SESSION['edit']['authority'], ENT_QUOTES)) ?></span>
                    </div>
                    <input class="edit_btn btn" type="submit" value="登録する">
                </div>
            </form>
        </div>
    </main>
</body>

</html>
<?php
session_start();
require_once('../common/dbconnect.php');
require_once('../common/session_check.php');

adminCheck($_SESSION);

// 入力チェック
if (!empty($_POST)) {
    $stmt = $db->prepare('DELETE FROM user_mst WHERE id=?');
    $stmt->execute(array($_SESSION['delete']['id']));
    $_SESSION['delete'] = $stmt->fetch();
        // ユーザー削除の際に使用したセッションを破棄する
        unset($_SESSION['delete']);
        header('Location: user_list.php');
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
            <h1 class="page-title">ユーザー削除</h1>
        </div>
    </header>
    <main class="main">
        <div class="main__container">
            <h2>以下のユーザーを削除します。</h2>
            <form action="" method="post">
                <input type="hidden" name="action" value="submit">
                <input type="hidden" name="user-id" value="<?php echo (htmlspecialchars($_SESSION['delete']['id'])) ?>>
                <div class=" user-name__area">
                <span class="user-name">姓名</span>
                <span type="text" class="user-first-name__input" name="user-first-name" value=""><?php echo (htmlspecialchars($_SESSION['delete']['first_name'])) ?></span>
                <span type="text" class="user-last-name__input" name="user-last-name" value=""><?php echo (htmlspecialchars($_SESSION['delete']['last_name'])) ?></span>
        </div>
        <div class="user-email__area">
            <span class="user-email">メールアドレス</span>
            <span type="text" class="user-email__input" name="user-email" value=""><?php echo (htmlspecialchars($_SESSION['delete']['email'])) ?></span>
        </div>
        <div class="employee-number__area">
            <span class="employee-number">社員番号</span>
            <span type="text" class="employee-number__input" name="employee-number" value=""><?php echo (htmlspecialchars($_SESSION['delete']['employee_number'])) ?></span>
        </div>
        <div class="authority__area">
            <span class="authority">管理者権限</span>
            <span name="authority" class="authority"><?php echo (htmlspecialchars($_SESSION['delete']['authority'])) ?>
            </span>
        </div>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
        </form>
        </div>
        <div class="menu__btn btn">
            <a href="staff_menu.php">管理メニューへ</a>
        </div>
    </main>

</body>

</html>
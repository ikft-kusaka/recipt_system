<?php
session_start();
require_once('../common/dbconnect.php');

// 入力チェック
if (!empty($_POST)) {
    if ($_POST['user-email'] === '') {
        $error['user-email'] = 'blank';
    }
    if ($_POST['user-password'] === '') {
        $error['user-password'] = 'blank';
    }
    if (empty($error)) {
        // エラーがない場合、ログイン処理
        $stmt = $db->prepare('SELECT * FROM user_mst WHERE email=? AND password=?');
        $stmt->execute(array(
            $_POST['user-email'],
            md5($_POST['user-password'])
        ));
        $rec = $stmt->fetch();
        
        // 該当データがあれば、一般もしくは管理者画面に遷移
        if ($rec > 0) {
            // 管理者、一般で遷移先を分ける
            if ($rec['authority'] === "0") {
                $_SESSION['general'] = $_POST;
                header('Location: ../general/general_menu.php');
            } else {
                $_SESSION['admin'] = $_POST;
                header('Location: ../staff/staff_top.php');
            }
        } else {
            $error['login'] = 'different';
        }
    }
    var_dump($rec);
}
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="../modern_css_reset.css">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="page-title">ログイン</h1>
        </div>
    </header>
    <main class="main">
        <div class="main__container">
            <form action="" method="post">
                <input type="hidden">
                <div class="login__form">
                    <div class="user-email__area">
                        <span class="user-email">メールアドレス</span>
                        <input type="text" class="user-email__input" name="user-email" value="<?php echo (htmlspecialchars($_POST['user-email'])) ?>" />
                        <?php if ($error['user-email']) : ?>
                            <p class="error-msg">*メールアドレスを入力してください。</p>
                        <?php endif ?>
                    </div>
                    <div class="user-password__area">
                        <span class="user-password">パスワード</span>
                        <input type="text" class="user-password__input" name="user-password" value="<?php echo (htmlspecialchars($_POST['user-password'])) ?>" />
                        <?php if ($error['user-password'] === 'blank') : ?>
                            <p class="error-msg">パスワードを入力してください</p>
                        <?php endif ?>
                        <?php if ($error['login'] === 'different') : ?>
                            <p class="error-msg">メールアドレスもしくはパスワードが異なります。</p>
                        <?php endif ?>
                    </div>
                    <input class="login__button btn" type="submit" value="ログイン">
                </div>
            </form>
        </div>
    </main>
</body>

</html>
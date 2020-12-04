<?php
session_start();
require('../dbconnect.php');

// 入力チェック
if (!empty($_POST)) {
    if ($_POST['user-id'] === '') {
        $error['user-id'] = 'blank';
    }

    if ($_POST['user-password'] === '') {
        $error['user-password'] = 'blank';
    }
}
if (empty($error)) {
    // エラーがない場合、ログイン処理
    $stmt = $db->prepare('SELECT user_id, password FROM user_mst WHERE user_id=? AND password=?');
    $stmt->execute(array(
        $_POST['user-id'],
        $_POST['user-password']
    ));
    $rec = $stmt->fetch();

    // 該当データがあれば、領収書入力画面に遷移
    if ($rec > 0) {
        $_SESSION['user-id'] = $rec['user_id'];
        $_SESSION['user-password'] = $rec['password'];
        header('Location: ../index.php');
    } else {
        $error['login'] = 'different';
    }
}


var_dump($_SESSION);
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
                <div class="login__form">
                    <div class="user-id__area">
                        <span class="user-id">ユーザーID</span>
                        <input type="text" class="user-id__input" name="user-id" value="<?php echo (htmlspecialchars($_POST['user-id'])) ?>" />
                        <?php if ($error['user-id']) : ?>
                            <p class="error-msg">*ユーザーIDを入力してください。</p>
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
                    <input class="login__button btn" type="submit" value="ログイン">
                </div>
            </form>
        </div>
    </main>
</body>

</html>
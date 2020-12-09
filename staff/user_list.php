<?php
session_start();
require_once('../common/dbconnect.php');
require_once('../common/session_check.php');

adminCheck($_SESSION);

$recs = $db->query('SELECT * FROM user_mst');

if (!empty($_POST)) {
    if (empty($_POST['user-id'])) {
        $error['user-id'] = 'selected';
    }

    $stmt = $db->prepare('SELECT * FROM user_mst WHERE id=?');
    $stmt->execute(array($_POST['user-id']));
    $user = $stmt->fetch();
    // クリックに応じて遷移
    switch (true) {
        case isset($_POST['user-add']):
            header('Location: user_add.php');
        break;
        case isset($_POST['edit']):
            $_SESSION['edit'] = $user;
            header('Location: user_edit.php');
        break;
        case isset($_POST['delete']):
            $_SESSION['delete'] = $user;
            header('Location: user_delete.php');
            break;
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
            <h1 class="page-title">ユーザー一覧</h1>
        </div>
    </header>
    <main class="main">
        <div class="main__container">
            <form action="" method="post">
                <input type="hidden">
                <?php if ($error['user-id'] === 'selected') : ?>
                    <p class="errror-msg">*ユーザーが選択されていません。</p>
                <?php endif ?>
                <table class="user__table">
                    <tr class="table__title">
                        <th class="table__content">ID</th>
                        <th class="table__content">氏名</th>
                        <th class="table__content">メールアドレス</th>
                        <th class="table__content">社員番号</th>
                        <th class="table__content">権限</th>
                    </tr>
                    <?php while ($rec = $recs->fetch()) : ?>
                        <tr>
                            <td class="table__content user__id"><input type="radio" name="user-id" value="<?php echo $rec['id'] ?>"></td>
                            <td class="table__content first-name__cell"><?php echo htmlspecialchars($rec['first_name'], ENT_QUOTES) . " " . htmlspecialchars($rec['last_name'], ENT_QUOTES) ?></td>
                            <td class="table__content first-name__cell"><?php echo htmlspecialchars($rec['email'], ENT_QUOTES) ?></td>
                            <td class="table__content first-name__cell"><?php echo htmlspecialchars($rec['employee_number'], ENT_QUOTES) ?></td>
                            <td class="table__content first-name__cell"><?php echo htmlspecialchars($rec['authority'], ENT_QUOTES) ?></td>
                        </tr>
                    <?php endwhile ?>
                </table>
                <input type="submit" value="修正" name="edit">
                <input type="submit" value="削除" name="delete">
            </form>
        </div>
        <div class="menu__btn btn">
            <a href="staff_menu.php">管理メニューへ</a>
        </div>
    </main>
</body>

</html>
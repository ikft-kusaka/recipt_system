<?php
session_start();
require_once('../common/dbconnect.php');
require_once('../common/session_check.php');
require_once('../common/page_branch.php');

adminCheck($_SESSION['admin']);

$counts = $db->query('SELECT COUNT(*) as cnt FROM customer_mst');
$count = $counts->fetch();
$max_page = ceil($count['cnt'] / 20);

if (isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
    $pageBefore = $page;
} else {
    $page = 1;
}

$page = $_REQUEST['page'];
$start = 20 * ($page - 1);

// $recs = $db->query('SELECT * FROM user_mst');

$stmt = $db->prepare('SELECT * FROM user_mst ORDER BY id ASC LIMIT ?, 20');
$stmt->bindParam(1, $start, PDO::PARAM_INT);
$stmt->execute();
$recs = $stmt;

if (!empty($_POST)) {
    if (!empty($_POST['user-edit']) || !empty($_POST['user-edit'])) {
        if (empty($_POST['user-id'])) {
            $error['user-id'] = 'selected';
        }
    } else {
        $stmt = $db->prepare('SELECT * FROM user_mst WHERE id=?');
        $stmt->execute(array($_POST['user-id']));
        $user = $stmt->fetch();
        jumpPage($_POST, $user);
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
    <link rel="stylesheet" href="admin.css">
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
                <table class="user__table" border="5">
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

                <?php if ($page >= 2) : ?>
                    <a href="user_list.php?page=<?php echo ($page - 1); ?>"><?php echo ($page - 1) ?>ページ目へ</a>
                <?php endif; ?>

                <?php if ($page < $max_page) : ?>
                    <a href="user_list.php?page=<?php echo ($page + 1); ?>"><?php echo ($page + 1) ?>ページ目へ</a>
                <?php endif; ?>

                <input type="submit" value="追加" name="user-add">
                <input type="submit" value="修正" name="user-edit">
                <input type="submit" value="削除" name="user-delete">
            </form>
        </div>
        <div class="menu__btn btn">
            <a href="admin_menu.php">管理メニューへ</a>
        </div>
    </main>
</body>

</html>
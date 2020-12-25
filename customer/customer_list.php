<?php
session_start();
require_once('../common/dbconnect.php');
require_once('../common/session_check.php');
require_once('../common/page_branch.php');

generalCheck($_SESSION['general'], $_SESSION['admin']);

$counts = $db->query('SELECT COUNT(*) as cnt FROM customer_mst');
$count = $counts->fetch();
$max_page = ceil($count['cnt'] / 50);

if (isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
    $pageBefore = $page;
} else {
    $page = 1;
}

$page = $_REQUEST['page'];
$start = 50 * ($page - 1);

switch (true) {
    case !empty($_POST['customer-search']):
        $stmt = $db->prepare("SELECT * FROM customer_mst WHERE customer_code LIKE '%" . $_POST['customer-code-s'] . "%' ORDER BY customer_code ASC LIMIT ?, 50");
        $stmt->bindParam(1, $start, PDO::PARAM_INT);
        $stmt->execute();
        $recs = $stmt;
        break;
    case !empty($_POST['katakana-search']):
        $stmt = $db->prepare("SELECT * FROM customer_mst WHERE customer_katakana_name LIKE '%" . $_POST['customer-katakana-s'] . "%' ORDER BY customer_code ASC LIMIT ?, 50");
        $stmt->bindParam(1, $start, PDO::PARAM_INT);
        $stmt->execute();
        $recs = $stmt;
        break;
    case !empty($_POST['recipt-add']):
        jumpPage($_POST);
    default:
        // $stmt = $db->prepare('SELECT * FROM customer_mst ORDER BY customer_code ASC LIMIT ?, 50');
        // $stmt->bindParam(1, $start, PDO::PARAM_INT);
        // $stmt->execute();
        // $recs = $stmt;
        break;
}




?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>得意先マスタ</title>
    <link rel="stylesheet" href="../modern_css_reset.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="page-title">得意先一覧</h1>
        </div>
    </header>
    <main class="main">
        <div class="main__container">
            <form action="" method="post">
                <input type="hidden">
                <input type="text" name="customer-code-s" placeholder="得意先コード" value="<?php echo (htmlspecialchars($_POST['customer-code-s'])) ?>">
                <input type="submit" name="customer-search" value="検索">
                <input type="text" name="customer-katakana-s" placeholder="得意先カナ名称" value="<?php echo (htmlspecialchars($_POST['customer-katakana-s'])) ?>">
                <input type="submit" name="katakana-search" value="検索">
                <?php if ($error['user-id'] === 'selected') : ?>
                    <p class="errror-msg">*ユーザーが選択されていません。</p>
                <?php endif ?>
                <table class="user__table" border="5">
                    <tr class="table__title">
                        <th class="table__content">選択</th>
                        <th class="table__content">得意先コード</th>
                        <th class="table__content">得意先名</th>
                        <th class="table__content">得意先カナ</th>
                        <th class="table__content">住所</th>
                        <th class="table__content">電話番号</th>
                        <th class="table__content">担当者コード</th>
                    </tr>
                    <?php if ($recs > 0) : ?>
                        <?php while ($rec = $recs->fetch()) : ?>
                            <tr>
                                <td class="table__content customer__code"><input type="radio" name="customer-code" value="<?php echo $rec['customer_code'] ?>"></td>
                                <td class="table__content customer__code"><?php echo $rec['customer_code'] ?></td>
                                <td class="table__content "><?php echo $rec['customer_name'] ?></td>
                                <td class="table__content "><?php echo $rec['customer_katakana_name'] ?></td>
                                <td class="table__content "><?php echo $rec['address'] ?></td>
                                <td class="table__content "><?php echo $rec['tel_number'] ?></td>
                                <td class="table__content "><?php echo $rec['contact_code'] ?></td>
                            </tr>
                        <?php endwhile ?>
                    <?php endif ?>
                </table>
                <input type="submit" name="recipt-add" value="得意先コードを選択" />

                <?php if ($page >= 2) : ?>
                    <a href="customer_list.php?page=<?php echo ($page - 1); ?>"><?php echo ($page - 1) ?>ページ目へ</a>
                <?php endif; ?>

                <?php if ($page < $max_page) : ?>
                    <a href="customer_list.php?page=<?php echo ($page + 1); ?>"><?php echo ($page + 1) ?>ページ目へ</a>
                <?php endif; ?>

                <?php var_dump($page, $max_page, $count['cnt']); ?>
            </form>
        </div>
    </main>
</body>

</html>
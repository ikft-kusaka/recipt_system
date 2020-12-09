<?php
session_start();
require_once('../common/dbconnect.php');
require_once('../common/session_check.php');
require_once('../common/page_branch.php');

adminCheck($_SESSION['admin']);

if (!empty($_POST)) {
    jumpPage($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="page-title">管理者メニュー</h1>
        </div>
    </header>
    <main class="main">
        <form class="admin__menu" action="" method="post">
            <button type="submit" class="admin__btn" name="admin-menu">管理メニューへ</button>
            <button type="submit" class="general__btn" name="general-menu">通常メニューへ</button>
        </form>
    </main>
</body>

</html>
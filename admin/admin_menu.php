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
    <title>管理者メニュー</title>
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="page-title">管理者メニュー</h1>
        </div>
    </header>
    <main class="main">
        <form class="admin__menu" action="" method="post">
            <button type="submit" class="user_list" name="user-list">ユーザー一覧</button>
            <button type="submit" class="user_add" name="user-add">ユーザー追加</button>
            <button type="submit" class="general_menu" name="general-menu">一般メニュー</button>
            <button type="submit" class="logout" name="logout">ログアウト</button> 
        </form>
    </main>
</body>

</html>
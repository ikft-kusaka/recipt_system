<?php
session_start();
require_once('../common/dbconnect.php');
require_once('../common/session_check.php');

adminCheck($_SESSION);

// クリックに応じて遷移
switch(true)
{
    case isset($_POST['user-list']):
        header('Location: user_list.php');
    break;
    case isset($_POST['user-add']):
        header('Location: user_add.php');
    break;
    case isset($_POST['general-menu']):
        header('Location: general_menu.php');
    break;
    case isset($_POST['logout']):
        userLogout();
    break;
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
        <form class="staff__menu" action="" method="post">
            <button type="submit" class="user_list" name="user-list">ユーザー一覧</button>
            <button type="submit" class="user_add" name="user-add">ユーザー追加</button>
            <button type="submit" class="general_menu" name="general-menu">一般メニュー</button>
            <button type="submit" class="logout" name="logout">ログアウト</button> 
        </form>
    </main>
</body>

</html>
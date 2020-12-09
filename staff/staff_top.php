<?php
session_start();
require_once('../common/dbconnect.php');
require_once('../common/session_check.php');

adminCheck($_SESSION);

if (!empty($_POST)) {
    // クリックで遷移先変更
    if(isset($_POST['staff-menu'])) {
        header('Location: staff_menu.php');
    } else {
        header('Location: user_menu.php');
    }
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
        <form class="staff__menu" action="" method="post">
            <button type="submit" class="staff__btn" name="staff-menu">管理メニューへ</button>
            <button type="submit" class="user__btn" name="user-menu">通常メニューへ</button>
        </form>
    </main>
</body>

</html>
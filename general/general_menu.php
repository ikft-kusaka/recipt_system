<?php
session_start();
require_once('../common/session_check.php');
require_once('../common/logout.php');

generalCheck($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メニュー</title>
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="page-title">一般メニュー</h1>
        </div>
    </header>
    <main class="main">
        <form class="staff__menu" action="" method="post">
            <button type="submit" class="user_add" name="user-add">ユーザー追加</button>
            <button type="submit" class="user_edit" name="user-edit">ユーザー編集</button>
            <button type="submit" class="user_delete" name="user-delete">ユーザー削除</button>
        </form>
    </main>
</body>

</html>
<?php
session_start();
require_once('../common/session_check.php');
require_once('../common/logout.php');

generalCheck($_SESSION['general'], $_SESSION['admin']);
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
        <form class="admin__menu" action="" method="post">
            <button type="submit" class="recipt-add__btn" name="user-add">領収書入力</button>
        </form>
    </main>
</body>

</html>
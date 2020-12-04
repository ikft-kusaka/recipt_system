<?php

// クリックに応じて遷移
switch(true)
{
    case isset($_POST['user-disp']):
        header('Location: user_disp.php');
    break;
    case isset($_POST['user-add']):
        header('Location: user_add.php');
    break;
    case isset($_POST['user-edit']):
        header('Location: user_edit.php');
    break;
    case isset($_POST['user-delete']):
        header('Location: user_delete.php');
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
            <button type="submit" class="user_disp" name="user-disp">ユーザー一覧</button>
            <button type="submit" class="user_add" name="user-add">ユーザー追加</button>
            <button type="submit" class="user_edit" name="user-edit">ユーザー編集</button>
            <button type="submit" class="user_delete" name="user-delete">ユーザー削除</button>
        </form>
    </main>
</body>

</html>
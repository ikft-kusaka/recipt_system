<?php
function jumpPage($post, $user = null)
{
    switch (true) {
        case isset($post['user-add']):
            header('Location: ../staff/user_add.php');
            break;
        case isset($post['user-edit']):
            $_SESSION['user-edit'] = $user;
            header('Location: ../staff/user_edit.php');
            break;
        case isset($post['user-delete']):
            $_SESSION['user-delete'] = $user;
            header('Location: ../staff/user_delete.php');
            break;
        case isset($post['user-list']):
            header('Location: ../staff/user_list.php');
            break;
        case isset($post['general-menu']):
            header('Location: ../general/general_menu.php');
            break;
        case isset($post['logout']):
            userLogout();
            break;
        case isset($post['staff-menu']):
            header('Location: ../staff/staff_menu.php');
            break;
        case isset($post['user-menu']):
            header('Location: ../staff/user_menu.php');
        break;
    }
}
// クリックに応じて遷移

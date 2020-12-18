<?php
function jumpPage($post, $user = null)
{
    // postに応じて遷移先を変更
    switch (true) {
        case isset($post['user-add']):
            header('Location: ../admin/user_add.php');
            break;
        case isset($post['user-edit']):
            $_SESSION['user-edit'] = $user;
            header('Location: ../admin/user_edit.php');
            break;
        case isset($post['user-delete']):
            $_SESSION['user-delete'] = $user;
            header('Location: ../admin/user_delete.php');
            break;
        case isset($post['user-list']):
            header('Location: ../admin/user_list.php');
            break;
        case isset($post['general-menu']):
            header('Location: ../general/general_menu.php');
            break;
        case isset($post['logout']):
            userLogout();
            break;
        case isset($post['admin-menu']):
            header('Location: ../admin/admin_menu.php');
            break;
        case isset($post['user-menu']):
            header('Location: ../admin/user_menu.php');
        break;
        case isset($post['recipt-add']):
            header('Location: ../recipt/recipt_add.php');
        break;
    }
}

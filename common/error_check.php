<?php

// ログイン時のエラーチェック
function userLoginErrorCheck($post)
{
    if (!empty($post)) {
        if ($post['user-email'] === '') {
            $error['user-email'] = 'blank';
        }
        if ($post['user-password'] === '') {
            $error['user-password'] = 'blank';
        }
        if(!empty($error)) {
            return $error;
        }
    }
}

// ユーザー登録時のエラーチェック
function userAddErrorCheck($post) {

    if ($post['user-first-name'] === '' || $post['user-last-name'] === '') {
        $error['user-name'] = 'blank';
    }
    if ($post['user-email'] === '') {
        $error['user-email'] = 'blank';
    }
    // if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $post['user-email']) === 0) {
    //     $error['user-email'] = 'unmatch';
    // }
    if ($post['user-password'] === '') {
        $error['user-password'] = 'blank';
    }
    if ($post['user-password'] !== $post['user-password2']) {
        $error['user-password'] = 'different';
    }
    if ($post['employee-number'] === '') {
        $error['employee-number'] = 'blank';
    }
    // if (preg_match('/^([0-9]{4})$/', $post['employee-number']) === 0) {
    //     $error['employee-number'] = 'unmatch';
    // }
    if ($post['authority'] === '') {
        $error['authority'] = 'blank';
    }
    if(!empty($error)) {
        return $error;
    }
}

function userEditErrorCheck($post) {
    if ($post['user-first-name'] === '' || $post['user-last-name'] === '') {
        $error['user-name'] = 'blank';
    }
    if ($post['user-email'] === '') {
        $error['user-email'] = 'blank';
    }
    // if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $post['user-email']) === 0) {
    //     $error['user-email'] = 'unmatch';
    // }
    // if ($post['user-password'] === '') {
    //     $error['user-password'] = 'blank';
    // }
    // if ($post['user-password'] !== $post['user-password2']) {
    //     $error['user-password'] = 'different';
    // }
    if ($post['employee-number'] === '') {
        $error['employee-number'] = 'blank';
    }
    // if (preg_match('/^([0-9]{4})$/', $post['employee-number']) === 0) {
    //     $error['employee-number'] = 'unmatch';
    // }
    if ($post['authority'] === '') {
        $error['authority'] = 'blank';
    }
    if(!empty($error)) {
        return $error;
    }
}
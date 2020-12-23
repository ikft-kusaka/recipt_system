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

// 領収書入力エラーチェック
function reciptAddErrorCheck($post) {
    $today = date("Y-m-d H:i:s");
    if ($post['recipt-date'] > $today) {
      $error['recipt-date'] = 'greater';
    }
    if ($post['recipt-date'] === '') {
      $error['recipt-date'] = 'blank';
    }
    if ($post['customer-code'] === '') {
        $error['customer-code'] = 'blank';
    }
    if ($post['recipt-amount1'] === '' && $post['comsumpition-tax1'] === '') {
        $error['recipt-amount'] = 'none';
    }
    for ($i=1; $i <= 10; $i++) { 
        if($post["comsumpition-tax{$i}"] !== '') {
            if ($post["recipt-amount{$i}"] === '') {
                $error['recipt-amount'] = "blank";
                break;
            }
        }
    }
    if(!empty($error)) {
        return $error;
    }
}
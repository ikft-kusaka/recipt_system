<?php
session_start();

require_once('logout.php');

function generalCheck($session)
{
    if (!empty($session['general']) || !empty($session['admin'])) {
        userLogout();
    }
}

function adminCheck($session)
{
    if (empty($session['admin'])) {
        userLogout();
    }
}

function userAddCheck($session) {
    if (empty($session['add'])) {
        header('Location: ../staff/user_menu.php');
        exit();
    }
}

function userEditCheck($session) {
    if (empty($session['edit'])) {
        header('Location: ../staff/user_menu.php');
        exit();
    }
}

function userDeleteCheck($session) {
    if (empty($session['delete'])) {
        header('Location: ../staff/user_menu.php');
        exit();
    }
}
<?php
session_start();

require_once('logout.php');

function generalCheck($sessionGeneral, $sessionAdmin)
{
    if (!empty($sessionGeneral) || !empty($sessionAdmin)) {
    } else {
        userLogout();
    }
}

function adminCheck($sessionAdmin)
{
    if (empty($sessionAdmin)) {
        userLogout();
    }
}

function userAddCheck($sessionAdd)
{
    if (empty($sessionAdd)) {
        header('Location: ../staff/user_menu.php');
        exit();
    }
}

function userEditCheck($sessionEdit)
{
    if (empty($sessionEdit)) {
        header('Location: ../general/general_menu.php');
        exit();
    }
}

function userDeleteCheck($sessionDelete)
{
    if (empty($sessionDelete)) {
        header('Location: ../staff/user_menu.php');
        exit();
    }
}

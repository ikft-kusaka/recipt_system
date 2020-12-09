<?php
session_start();

function userLogout()
{
    // $_SESSION = array();
    if (isset($_COOKIE[session_name()]) === true) {
        setcookie(session_name(), '', time() - 42000, '/');
    }
    session_destroy();
    header("Location: ../login/index.php");
    exit();
}

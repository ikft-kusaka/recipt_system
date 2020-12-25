<?php
    require_once('/common/dbconnect.php');



    // function pagenation($db, $tableName, $number) {
    //     $counts = $db->query("SELECT COUNT(*) as cnt FROM ${tableName}");
    //     $count = $counts->fetch();
    //     $maxPage = ceil($count['cnt'] / $number);
        
    //     if (isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
    //         $page = $_REQUEST['page'];
    //         $pageBefore = $page;
    //     } else {
    //         $page = 1;
    //     }
        
    //     $page = $_REQUEST['page'];
    //     $start = $number * ($page - 1);

    //     return [$maxPage, $start];
    // }

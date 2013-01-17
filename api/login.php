<?php
    require '../lib/user.inc.php';
    
    $user = new User();
    session_start();
    if (!isset($_POST['user'])) {
        if (isset($_GET['logout'])) {
            $user->logout();
            $url="../login.php";
            header("Location: $url");
            exit();
        }
        $ret = '{"succ: FALSE, "error": "user?"}';
    } else {
        $login = json_decode($_POST['user']);
        $ret = $user->login($login->name, $login->passwd);
    }
    
    if ($ret) {
        echo $ret;
    } else {
        echo $user->getErr();
    }
?>
<?php
     require '../lib/err.php';
     require '../lib/user.inc.php';
     
     $do = 'get';
     if (isset($_GET['do'])) {
         $do = $_GET['do'];
     }
     
     $user = new User();
     if (isset($_SESSION['id'])) {
         $uid = $_SESSION['id'];
     } else {
         $uid = 1;
     }
     switch (strtolower($do)) {
         case 'get':
             $ret = $user->getUsers();
             break;
         case 'add':
             if (isset($_POST['user'])) {
                 $ret = $user->add($uid, json_decode($_POST['user']));
             } else {
                 $ret = $user->getErr("user?");
             }
             break;
         case 'update':
             if (isset($_POST['user'])) {
                 $ret = $user->update($uid, json_decode($_POST['user']));
             } else {
                 $ret = $user->getErr("user?");
             }
             break;
         case 'delete':
             if (isset($_POST['user'])) {
                 $ret = $user->delete($uid, json_decode($_POST['user']));
             } else {
                 $ret = $user->getErr("user?");
             }
             break;
         case 'log':
             $ret = $user->getLog();
             break;
     }
     
     if ($ret) {
         echo $ret;
     } else {
         echo $user->getErr();
     }
?>
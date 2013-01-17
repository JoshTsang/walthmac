<?php
     require '../lib/user.inc.php';
     
     $do = 'get';
     if (isset($_GET['do'])) {
         $do = $_GET['do'];
     }
     
     $user = new User();
     switch (strtolower($do)) {
         case 'get':
             $ret = $user->getUsers();
             break;
         case 'add':
             if (isset($_POST['user'])) {
                 $ret = $user->add(json_decode($_POST['user']));
             } else {
                 $ret = $user->getErr("user?");
             }
             break;
         case 'update':
             if (isset($_POST['user'])) {
                 $ret = $user->update(json_decode($_POST['user']));
             } else {
                 $ret = $user->getErr("user?");
             }
             break;
         case 'delete':
             if (isset($_POST['user'])) {
                 $ret = $user->delete(json_decode($_POST['user']));
             } else {
                 $ret = $user->getErr("user?");
             }
             break;
     }
     
     if ($ret) {
         echo $ret;
     } else {
         echo $user->getErr();
     }
?>
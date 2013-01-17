<?php
    require "element.php";
    require 'lib/html.inc.php';
    $elements = new element();
    $html = new HtmlStructure();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>walthmac</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <style type="text/css">
      body {
        background-color: transparent;
        padding-top: 40px;
      }
      .navbar-fixed-top {
        margin-bottom: 0 !important;
      }
      
      input {
          margin-bottom: 15px;
          margin-top: 15px;
      }
      
      #permissionSelection {
          margin-bottom: 15px;
          margin-top: 15px;
      }
      
      #title {
          font-size: 24px;
          margin-top: 8px;
          margin-left: 10px;
          text-align: center;
          color: #FFFFFF;
      }
    </style>

    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <ul class="nav">
                    <?php 
                        if (isset($_GET['uid'])) {
                            echo '<span id="uid" style="display: none">'.$_GET['uid'].'</span>';
                            echo '<div id="title">修改用户</div>';
                        } else {
                            echo '<div id="title">添加用户</div>';
                        }
                    ?>
                 
                </ul>
          <div class="pull-right" style="margin-right: 15px"><a class="btn btn-primary" href="manage.php">返回</a></div>
        </div>
    </div>
    <div class="container-fluid" style="margin-left: auto; margin-right: auto; width:240px;">
        <form class="form-horizontal">
                  <?php 
                        if(isset($_GET['uname'])) {
                            echo '<input type="text" id="uname" placeholder="用户名" value="'.$_GET['uname'].'" disabled="disabled">';
                        } else {
                            echo '<input type="text" id="uname" placeholder="用户名" >';
                        }
                  ?>
                  <span style="color: #FF0000">*</span>
              <?php if(!isset($_GET['uname']) || @($_SESSION['user'] == $_GET['uname'])) { ?>
              
              <div id="pwd">
                  <input type="password" id="passwd" placeholder="密码">
                  <span style="color: #FF0000">*</span>
                  <input type="password" id="pwdConfirm" placeholder="确认密码">
                  <span style="color: #FF0000">*</span>
              </div>
              <?php 
                    }
                    if($_SESSION['permission'] >= 3) { ?>
              <div id="permissionSelection">
                  权限: 
                <select id="permission" style="width:170px">';
                    <?php
                        echo '<option value="0">浏览权限</option>';
                        if ($_SESSION['permission'] >= 1) {
                            echo '<option value="1">操作权限</option>';
                        }
                        
                        if ($_SESSION['permission'] >= 2) {
                            echo '<option value="2">管理权限</option>';
                        }
                        if ($_SESSION['permission'] >= 2) {
                           echo '<option value="3">超级用户</option>';
                        }
                    ?>
                </select>
              </div>
              <?php } ?>
              <a id="addUserBtn" class="btn btn-primary pull-right" style="margin-top: 25px">确定</a>
        </form>
    </div>
    <?php include "footer.inc.php"; ?>
    <script type="text/javascript" src="js/user.js"></script>
    <script>
    <?php 
        if(isset($_GET['permission'])) {
            echo 'if (document.getElementById("permission") != null) {document.getElementById("permission").value="'.$_GET['permission'].'";}';
        }
    ?>
        $(document).ready(
            function(){
                <?php 
                    if (isset($_GET['uid'])) {
                        echo '$("#addUserBtn").click({id:'.$_GET['uid'].'}, users.update);';
                    } else {
                        echo '$("#addUserBtn").click(users.add);';
                    }
                ?>
            }
        );
    </script>
  </body>
</html>
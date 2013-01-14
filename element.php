<?php
    define('MENU_DB', '../db/dish.db3');
    
    define('CATEGORIES', "category");
    define('UNITS', 'unit');
    define("DISHES", 'dishInfo');
    define("DISH_CATEGORY", "dishCategory");
    define("PRINTERS", 'sortPrint');
    class element {
        // function __construct() {
            // session_start();
            // if (!$_SESSION['logedin']) {
                // $url="login.php";
                // header("Location: $url");
            // }
        // }
        
        public function navBar($active) {
        	echo '<div class="navbar navbar-fixed-top navbar-inverse">
                    <div class="navbar-inner">
                          <ul class="nav">';
                          
             echo '          <li '.($active==1?'class="active"':"").'><a href="status.php">状态</a></li>';
             echo '          <li '.($active==2?'class="active"':"").'><a href="alert.php">报警</a></li>';
             echo '          <li '.($active==3?'class="active"':"").'><a href="args.php">参数</a></li>';
             echo '          <li '.($active==4?'class="active"':"").'><a href="manage.php">管理</a></li>';
             
             echo '       </ul>
                          <div class="pull-right" style="margin-top:12px; margin-right:15px;"><a href="login.php"><i class="icon-off"></i></a></div>
                      </div>
                    </div>';
           $this->alertDlg();
        }

        public function warningBlock($id) {
            echo '<div class="alert alert-error fade in hide" id="'.$id.'">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <span id="warning"></span>
                    </div>';
        }

        public function css() {
            echo '<link href="css/bootstrap.css" rel="stylesheet">
                  <link href="css/manage.css" rel="stylesheet">';
        }
        
        private function getUserName() {
            return $_SESSION['user'];
        }
        
        private function getPermission() {
            return $_SESSION['permission'];
        }
        
        private function alertDlg() {
            echo '<div class="modal hide fade" id="alertDlg" role="dialog">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 id="alertTitle"></h3>
                       </div>
                      <div id="alertMsg" class="modal-body">
                        
                      </div>
                      <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
                        <a id="alertPositiveBtn" href="#" class="btn btn-primary" data-dismiss="modal">确定</a>
                      </div>
                    </div>';
        }
    }
?>
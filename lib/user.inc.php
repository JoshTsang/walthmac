<?php
    define('USER_DB', '../data/user.db');
    
    class User {
        private $userDB;
        private $error = array("err_code" => 0);
        
        public function login($name, $pwd) {
            if (!$this->connetDB()) {
                return FALSE;
            }
            $users = array();
            $sql = sprintf("SELECT * FROM user where name='%s'", $name);
            $ret = $this->userDB->query($sql);
            if ($ret) {
                if ($row = $ret->fetchArray()) {
                   if (strtolower($pwd) == strtolower(md5($row[2]))) {
                        $_SESSION['user'] = $row[1];
                        $_SESSION['id'] = $row[0];
                        $_SESSION['permission'] = $row[3];
                        $_SESSION['logedin'] = TRUE;
                        $_SESSION['time'] = time();
                        $login = array('username' => $row[1],
                                       'uid' => $row[0],
                                       'permission' => $row[3]);
                        $this->log($row[0], "登陆系统");
                       return json_encode($login);
                   } else {
                       $this->setErr(PWD_INCORRECT, "pwd incorrect, you:".$pwd.",db:" . $row[2]);
                       return FALSE;
                   }
                } else {
                    $this->setErr(USER_NOT_EXIST, "no such user");
                }
            } else {
                $this->setErr(DB_ERR, $this->userDB->lastErrorMsg()."#$sql");
                return FALSE;
            }
        }
        
        public function logout() {
            $_SESSION['logedin'] = FALSE;
        }
        
        //TODO uid
        public function add($uid, $user) {
            if (isset($user->name) && isset($user->pwd) && isset($user->permission)) {
                $sql = sprintf("INSERT INTO user values(null, '%s', '%s', %s)", 
                                $user->name, $user->pwd, $user->permission);
                $ret = $this->sqlExec($sql);
                if ($ret === FALSE) {
                    return FALSE;
                } else {
                    $this->log($uid, "创建用户：".$user->name);
                }
            } else {
                $this->setErr(PARAM_ERR, "name?pwd?permission");
                return false;
            }
        }
        
        //todo uid
        public function update($uid, $user) {
            if (!isset($user->id)) {
                $this->setErr(PARAM_ERR, "id?");
                return FALSE;
            }
            if (isset($user->pwd) && isset($user->permission)) {
                $sql = sprintf("UPDATE user SET pwd='%s', permission=%s where id=%s",
                          $user->pwd, $user->permission, $user->id);
                return $this->sqlExec($sql); 
            } else if (isset($user->pwd)) {
                $sql = sprintf("UPDATE user SET pwd='%s' where id=%s",
                          $user->pwd, $user->id);
                return $this->sqlExec($sql);
            } else if (isset($user->permission)) {
                $sql = sprintf("UPDATE user SET permission=%s where id=%s",
                          $user->permission, $user->id);
                return $this->sqlExec($sql);
            } else {
                $this->setErr(PARAM_ERR, "name?pwd?permission");
                return false;
            }
        }
        
        //todo uid
        public function delete($uid, $user) {
            if (!isset($user->id)) {
                $this->setErr(PARAM_ERR, "id?");
                return FALSE;
            }
            $sql = "DELETE FROM user WHERE id=".$user->id;
            $ret = $this->sqlExec($sql);
            if ($ret == FALSE) {
                return FALSE;
            } else {
                $this->log($uid, "删除用户：".$user->id);
            }
        }
        
        public function getUsers() {
            if (!$this->connetDB()) {
                return FALSE;
            }
            
            $users = array();
            $sql = "SELECT * FROM user";
            $ret = $this->userDB->query($sql);
            if ($ret) {
                $i = 0;
                while ($row = $ret->fetchArray()) {
                    $users[$i] = array('id' => $row[0],
                                       'name' => $row[1],
                                       'permission' => $row[3]);
                    $i++;
                }
            } else {
                $this->setErr(DB_ERR, $this->userDB->lastErrorMsg()."#$sql");
                return FALSE;
            }
            
            return json_encode($users);
        }
        
        public function log($uid, $action) {
            $sql = "INSERT INTO log values(null, $uid, datetime(), '$action')";
            if ($this->sqlExec($sql) === FALSE) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
        
        public function getLog() {
            if (!$this->connetDB()) {
                return FALSE;
            }
            
            $users = array();
            $sql = "SELECT name,timestamp,action FROM log, user WHERE user.id = log.uid";
            $ret = $this->userDB->query($sql);
            if ($ret) {
                $i = 0;
                while ($row = $ret->fetchArray()) {
                    $users[$i] = array('who' => $row[0],
                                       'when' => $row[1],
                                       'what' => $row[2]);
                    $i++;
                }
            } else {
                $this->setErr(DB_ERR, $this->userDB->lastErrorMsg()."#$sql");
                return FALSE;
            }
            
            return json_encode($users);
        }
        
        public function getErr($msg = null) {
            if ($msg != null) {
                $this->setErr(1, $msg);
            }
            return json_encode($this->error);
        }
        
        private function errNone() {
        }
        
        private function sqlExec($sql) {
            if (!$this->connetDB()) {
                return FALSE;
            }
            
            @$ret = $this->userDB->exec($sql); 
            if ($ret) {
                $this->errNone();
                return $this->getErr();
            } else {
                $this->setErr(DB_ERR, $this->userDB->lastErrorMsg()."#$sql");
                return FALSE;
            }
        }
        
        private function createDB() {
            $this->userDB = new SQLite3(USER_DB);
            $sql = "CREATE TABLE [user] (
                    [id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                    [name] CHAR(33)  NOT NULL,
                    [pwd] CHAR(33)  NOT NULL,
                    [permission] INTEGER NOT NULL);";
            $ret = $this->userDB->exec($sql);
            if (!$ret) {
                $this->setErr(DB_ERR, $this->userDB->lastErrorMsg());
                return false;
            }个和进口量；
            
            $sql = "CREATE TABLE [log] (
                    [id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                    [uid] INTEGER  NOT NULL,
                    [timestamp] TIMESTAMP  NOT NULL,
                    [action] TEXT NOT NULL);";
            $ret = $this->userDB->exec($sql);
            if (!$ret) {
                $this->setErr(DB_ERR, $this->userDB->lastErrorMsg());
                return false;
            }
            $sql = "INSERT INTO user values(null, 'admin', 'admin', 3)";
            $ret = $this->userDB->exec($sql);
            if (!$ret) {
                $this->setErr(DB_ERR, $this->userDB->lastErrorMsg());
                return false;
            }
            return true;
        }
        
        private function setErr($err_code, $msg) {
            $this->error['err_code'] = $err_code;
            $this->error['err_msg'] = $msg;
        }
        
        private function connetDB() {
            if ($this->userDB == null) {
                if (file_exists(USER_DB)) {
                    $this->userDB = new SQLite3(USER_DB);
                    if (!$this->userDB) {
                        $this->setErr(DB_ERR, 'could not connect db:'.DATABASE_MENU);
                        return false;
                    }
                } else {
                    return $this->createDB();
                }
            }
            
            return true;
        }
    }
?>
<?php
    define('USER_DB', '../data/user.db');
    
    class User {
        private $userDB;
        private $error = array("succ" => FALSE, "msg" => "");
        
        public function login($name, $pwd) {
            if (!$this->connetDB()) {
                return FALSE;
            }
            $users = array();
            $sql = sprintf("SELECT * FROM user where name='%s'", $name);
            $ret = $this->userDB->query($sql);
            if ($ret) {
                if ($row = $ret->fetchArray()) {
                   if ($pwd == md5($row[2])) {
                        $_SESSION['user'] = $row[1];
                        $_SESSION['id'] = $row[0];
                        $_SESSION['permission'] = $row[3];
                        $_SESSION['logedin'] = TRUE;
                        $_SESSION['time'] = time();
                       $this->errNone();
                       return $this->getErr();
                   } else {
                       $this->setErr("pwd incorrect");
                       return FALSE;
                   }
                } else {
                    $this->setErr("no such user");
                }
            } else {
                $this->setErr($this->userDB->lastErrorMsg()."#$sql");
                return FALSE;
            }
        }
        
        public function logout() {
            $_SESSION['logedin'] = FALSE;
        }
        
        public function add($user) {
            if (isset($user->name) && isset($user->pwd) && isset($user->permission)) {
                $sql = sprintf("INSERT INTO user values(null, '%s', '%s', %s)", 
                                $user->name, $user->pwd, $user->permission);
                return $this->sqlExec($sql); 
            } else {
                $this->setErr("name?pwd?permission");
                return false;
            }
        }
        
        public function update($user) {
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
                $this->setErr("name?pwd?permission");
                return false;
            }
        }
        
        public function delete($user) {
            $sql = "DELETE FROM user WHERE id=".$user->id;
            return $this->sqlExec($sql);
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
                $this->setErr($this->userDB->lastErrorMsg()."#$sql");
                return FALSE;
            }
            
            return json_encode($users);
        }
        
        public function getErr($msg = null) {
            if ($msg != null) {
                $this->setErr($msg);
            }
            return json_encode($this->error);
        }
        
        private function errNone() {
            $this->error['succ'] = TRUE;
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
                $this->setErr($this->userDB->lastErrorMsg()."#$sql");
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
                $this->setErr($this->userDB->lastErrorMsg());
                return false;
            }
            
            $sql = "INSERT INTO user values(null, 'admin', 'admin', 3)";
            $ret = $this->userDB->exec($sql);
            if (!$ret) {
                $this->setErr($this->userDB->lastErrorMsg());
                return false;
            }
            return true;
        }
        
        private function setErr($msg) {
            $this->error['msg'] = $msg;
        }
        
        private function connetDB() {
            if ($this->userDB == null) {
                if (file_exists(USER_DB)) {
                    $this->userDB = new SQLite3(USER_DB);
                    if (!$this->userDB) {
                        $this->setErr('could not connect db:'.DATABASE_MENU);
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
<?php
    class HtmlStructure {
        private $data = array(
            array('name' => '米重设定值','id'=> '', 'unit' => 'kg/m', 'setable' => FALSE),
            array('name' => '米重实际值','id'=> '', 'unit' => 'kg/m', 'setable' => FALSE),
            array('name' => '挤出量设定值','id'=> '', 'unit' => 'kg/h', 'setable' => FALSE),
            array('name' => '挤出量实际值','id'=> '', 'unit' => 'kg/h', 'setable' => FALSE),
            array('name' => '挤出机状态','id'=> '', 'unit' => '', 'setable' => TRUE, 'divider' => TRUE),
            array('name' => '挤出率','id'=> '', 'unit' => 'g/rev', 'setable' => FALSE),
            array('name' => '螺杆速度','id'=> '', 'unit' => 'RPM', 'setable' => FALSE),
            array('name' => '牵引速度','id'=> '', 'unit' => 'm/m', 'setable' => FALSE, 'divider' => TRUE),
            array('name' => '挤出机给定电压','id'=> '', 'unit' => 'mv', 'setable' => FALSE),
            array('name' => '挤出机输出电压','id'=> '', 'unit' => 'mv', 'setable' => FALSE),
            array('name' => '牵引机给定电压','id'=> '', 'unit' => 'mv', 'setable' => FALSE),
            array('name' => '牵引机输出电压','id'=> '', 'unit' => 'mv', 'setable' => FALSE, 'divider' => TRUE),
            array('name' => '累计挤出长量','id'=> '', 'unit' => 'kg', 'setable' => FALSE),
            array('name' => '挤出长度','id'=> '', 'unit' => 'm', 'setable' => FALSE, 'divider' => TRUE),
            array('name' => '','id'=> '', 'unit' => '', 'setable' => FALSE),);
        
        private $args = array(
            array('name' => '挤出机克每转过滤系数','id'=> '', 'unit' => '个', 'permission' => 0),
            array('name' => '挤出机调解过滤系数','id'=> '', 'unit' => '个', 'permission' => 0),
            array('name' => '挤出机P参数','id'=> '', 'unit' => '', 'permission' => 0),
            array('name' => '挤出机I参数 ','id'=> '', 'unit' => '', 'permission' => 0),
            array('name' => '挤出机P控制死区','id'=> '', 'unit' => '%', 'permission' => 0),
            array('name' => '挤出量报警上限','id'=> '', 'unit' => '%', 'permission' => 0),
            array('name' => '挤出量报警下限','id'=> '', 'unit' => '%', 'permission' => 0),
            array('name' => '挤出机开机最小速度','id'=> '', 'unit' => 'RPM', 'permission' => 0),
            array('name' => '最大挤出机速度','id'=> '', 'unit' => 'RPM', 'permission' => 0),
            array('name' => '挤出机零点死区','id'=> '', 'unit' => 'mv', 'permission' => 0),
            array('name' => '牵引机过滤系数','id'=> '', 'unit' => '个', 'permission' => 0),
            array('name' => '牵引机惯性过滤系数','id'=> '', 'unit' => '个', 'permission' => 0),
            array('name' => '牵引机P参数','id'=> '', 'unit' => '', 'permission' => 0),
            array('name' => '牵引机I参数 ','id'=> '', 'unit' => '', 'permission' => 0),
            array('name' => '牵引机P控制死区','id'=> '', 'unit' => '%', 'permission' => 0),
            array('name' => '米重值报警上限','id'=> '', 'unit' => '%', 'permission' => 0),
            array('name' => '米重值报警下限','id'=> '', 'unit' => '%', 'permission' => 0),
            array('name' => '牵引机开机最小速度','id'=> '', 'unit' => 'm/min', 'permission' => 0),
            array('name' => '牵引机最大牵引速度','id'=> '', 'unit' => 'm/min', 'permission' => 0),
            array('name' => '牵引机零点死区','id'=> '', 'unit' => 'mv', 'permission' => 0),
            array('name' => '系统运行模式','id'=> '', 'unit' => '', 'permission' => 0),
            array('name' => '重力传感器校正系数','id'=> '', 'unit' => '', 'permission' => 0),
            array('name' => '米重显示过滤系数','id'=> '', 'unit' => '', 'permission' => 0),
            array('name' => '料斗低料位','id'=> '', 'unit' => 'g', 'permission' => 0),
            array('name' => '报警料斗低料位','id'=> '', 'unit' => 'g', 'permission' => 0),
            array('name' => '料斗高料位','id'=> '', 'unit' => 'g', 'permission' => 0),
            array('name' => '报警料斗高料位','id'=> '', 'unit' => 'g', 'permission' => 0),
            array('name' => '零点料位','id'=> '', 'unit' => 'g', 'permission' => 0),
            array('name' => '加料后计算重量延迟','id'=> '', 'unit' => 's', 'permission' => 0),
            array('name' => '挤出机最大加速时间','id'=> '', 'unit' => 's', 'permission' => 0),
            array('name' => '','id'=> '', 'unit' => '', 'permission' => 0),
        );
        
        private $users = array(
            array('name' => 'admin','id'=> '', 'permission' => 0),
            array('name' => 'test1','id'=> '', 'permission' => 0),
            array('name' => 'test2','id'=> '', 'permission' => 0),
            array('name' => 'test3','id'=> '', 'permission' => 0),
            array('name' => '','id'=> '', 'permission' => 0),
        );
        
        public function status($permission) {
            $count = count($this->data) - 1;
            
            echo '<table class="table table-striped ">';
            for($i=0; $i<$count; $i++) {
                if (isset($this->data[$i]['divider'])) {
                    echo '<tr style="border-bottom:2px solid #0D7DCB !important">';
                    
                } else {
                    echo '<tr>';
                }
                echo '<td class="argName">'.($this->data[$i]['name']).':</td>'.
                    '<td><span id="'.($this->data[$i]['id']).'" class="argValue">value</span><span class="unit"> '.
                    ($this->data[$i]['unit']).'</span>'.
                    ($this->data[$i]['setable']?'&nbsp;&nbsp;<button class="btn btn-primary pull-right" type="button" data-toggle="modal">切换</button>':"").'</td></tr>';
            }
            echo '</table>';
        }
        
        public function alert() {
            echo '<table class="table table-striped ">';
            for($i=0; $i<20; $i++) {
                echo '<tr><td><span class="alertInfo">报警信息'.($i+1).
                '</span><br/><spsan class="alertTime pull-right">2013-01-01 01:01:01</span></td></tr>';
            }
            echo '</table>';
        }
        
        public function args($permission) {
            $count = count($this->args) - 1;
            echo '<table class="table table-striped ">';
            for($i=0; $i<$count; $i++) {
                echo '<tr><td class="argName">'.($this->args[$i]['name']).':</td>'.
                '<td><span id="'.($this->args[$i]['id']).
                '" class="argValue">value</span> '.($this->args[$i]['unit']).
                '<span></span></td><td><button class="btn btn-primary" type="button" data-toggle="modal">修改</button></td></tr>';
            }
            echo '</table>';
        }
        
        public function manage($permission) {
            $count = count($this->users) - 1;
            echo '<div class="pull-right" style="margin-top:20px; margin-bottom:20px; margin-right:20px;"><button class="btn btn-primary" type="button" data-toggle="modal">添加</button></div>';
            echo '<table class="table table-striped ">';
            for($i=0; $i<$count; $i++) {
                echo '<tr><td class="argName">'.($this->users[$i]['name']).'</td>'.
                '<td><button class="btn btn-primary" type="button" data-toggle="modal">修改</button></td></tr>';
            }
            echo '</table>';
        }
    }
?>
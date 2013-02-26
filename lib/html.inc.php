<?php
    class HtmlStructure {
        private $data = array(
            array('title' => '运行状态'),
            array('name' => '米重设定值','id'=> 'setkgPerMeter', 'unit' => 'kg/m',
                 'setable' => TRUE, 'btn' => '设置', 'setper' => 1),
            array('name' => '米重实际值','id'=> 'kgPerMeterShow', 'unit' => 'kg/m', 'setable' => FALSE),
            array('name' => '牵引机状态','id'=> 'autoManualstateOfDragger', 'unit' => ''
                    , 'setable' => TRUE, 'btn' => '切换', 'divider' => TRUE, 'setper' => 1),
            array('name' => '挤出量设定值','id'=> 'setWgtPerHour', 'unit' => 'kg/h',
                 'setable' => TRUE, 'btn' => '设置', 'setper' => 1),
            array('name' => '挤出量实际值','id'=> 'wgtPerHour', 'unit' => 'kg/h', 'setable' => FALSE),
            array('name' => '挤出机状态','id'=> 'autoManualstateOfExtruder', 'unit' => '',
                 'setable' => TRUE, 'btn' => '切换', 'divider' => TRUE, 'setper' => 1),
            array('name' => '挤出率','id'=> 'wgtPerRev', 'unit' => 'g/rev', 'setable' => FALSE),
            array('name' => '螺杆速度','id'=> 'speedPerMin', 'unit' => 'RPM', 'setable' => FALSE),
            array('name' => '牵引速度','id'=> 'meterPerMin', 'unit' => 'm/m', 'setable' => FALSE, 'divider' => TRUE),
            array('title' => '挤出机'),
            array('name' => '给定电压','id'=> 'AIN2Extruder', 'unit' => 'mv', 'setable' => FALSE),
            array('name' => '输出电压','id'=> 'extrudDect', 'unit' => 'mv', 'setable' => FALSE),
            array('name' => '累计挤出量','id'=> 'wgtPerHourAddup', 'unit' => 'kg', 'setable' => FALSE),
            array('title' => '牵引机'),
            array('name' => '给定电压','id'=> 'AIN1Drager', 'unit' => 'mv', 'setable' => FALSE),
            array('name' => '输出电压','id'=> 'dragerDect', 'unit' => 'mv', 'setable' => FALSE),
            array('name' => '累计长度','id'=> 'meterAddup', 'unit' => 'm', 'setable' => FALSE, 'divider' => TRUE),
            array('name' => '','id'=> '', 'unit' => '', 'setable' => FALSE),);
        
        private $args = array(
            array('title' => '挤出机参数', 'dispPer' => 1),
            array('name' => '过滤系数','id'=> 'ExtrAlgLen', 'unit' => '个', 'dispPer' => 0, 'setPer' => 2),
            array('name' => '控制系数','id'=> 'ExtrAlgLendis', 'unit' => '个', 'dispPer' => 0, 'setPer' => 2, 'divider' => TRUE),
            array('name' => 'P参数','id'=> 'extrpGain', 'unit' => '', 'dispPer' => 0, 'setPer' => 2),
            array('name' => 'I参数 ','id'=> 'extriGain', 'unit' => '', 'dispPer' => 0, 'setPer' => 2),
            array('name' => 'P控制死区','id'=> 'extrDeadBand', 'unit' => '%', 'dispPer' => 0, 'setPer' => 2, 'divider' => TRUE),
            array('name' => '挤出量报警上限','id'=> 'WgtPerHWarnUp', 'unit' => '%', 'dispPer' => 0, 'setPer' => 2),
            array('name' => '挤出量报警下限','id'=> 'WgtPerHWarnDw', 'unit' => '%', 'dispPer' => 0, 'setPer' => 2, 'divider' => TRUE),
            array('name' => '最小转度','id'=> 'extrMinSpeed', 'unit' => 'RPM', 'dispPer' => 0, 'setPer' => 2),
            array('name' => '最大转速','id'=> 'maxSpdPerMin', 'unit' => 'RPM', 'dispPer' => 0, 'setPer' => 2, 'divider' => TRUE),
            array('name' => '零点死区','id'=> 'extrZeroDeadband', 'unit' => 'mv', 'dispPer' => 3, 'setPer' => 3, 'divider' => TRUE),
            array('title' => '牵引机参数', 'dispPer' => 0),
            array('name' => '过滤系数','id'=> 'calFrq', 'unit' => '个', 'dispPer' => 0, 'setPer' => 2),
            array('name' => '控制系数','id'=> 'calFrqdis', 'unit' => '个', 'dispPer' => 0, 'setPer' => 2, 'divider' => TRUE),
            array('name' => 'P参数','id'=> 'dragpGain', 'unit' => '', 'dispPer' => 0, 'setPer' => 2),
            array('name' => 'I参数 ','id'=> 'dragiGain', 'unit' => '', 'dispPer' => 0, 'setPer' => 2),
            array('name' => 'P控制死区','id'=> 'dragDeadBand', 'unit' => '%', 'dispPer' => 0, 'setPer' => 2, 'divider' => TRUE),
            array('name' => '米重值报警上限','id'=> 'kgPerMeterWarnUp', 'unit' => '%', 'dispPer' => 0, 'setPer' => 2),
            array('name' => '米重值报警下限','id'=> 'kgPerMeterWarnDw', 'unit' => '%', 'dispPer' => 0, 'setPer' => 2, 'divider' => TRUE),
            array('name' => '最小牵引速度','id'=> 'dragMinSpeed', 'unit' => 'm/min', 'dispPer' => 0, 'setPer' => 2),
            array('name' => '最大牵引速度','id'=> 'dragHighScope', 'unit' => 'm/min', 'dispPer' => 0, 'setPer' => 2, 'divider' => TRUE),
            array('name' => '零点死区','id'=> 'dragZeroDeadband', 'unit' => 'mv', 'dispPer' => 3, 'setPer' => 3, 'divider' => TRUE),
            array('title' => '系统参数', 'dispPer' => 3),
            array('name' => '系统运行模式','id'=> 'systemRunMode', 'unit' => '', 'dispPer' => 3, 'setPer' => 3),
            array('name' => '传感器系数','id'=> 'digitPerG', 'unit' => '', 'dispPer' => 3, 'setPer' => 3),
            array('name' => '米重显示系数','id'=> 'WgtPerMShLen', 'unit' => '', 'dispPer' => 3, 'setPer' => 3, 'divider' => TRUE),
            array('name' => '料斗低料位','id'=> 'hopper20', 'unit' => 'g', 'dispPer' => 3, 'setPer' => 3),
            array('name' => '报警料斗低料位','id'=> 'hopper20Warn', 'unit' => 'g', 'dispPer' => 3, 'setPer' => 3),
            array('name' => '料斗高料位','id'=> 'hopper80', 'unit' => 'g', 'dispPer' => 3, 'setPer' => 3),
            array('name' => '报警料斗高料位','id'=> 'hopper80Warn', 'unit' => 'g', 'dispPer' => 3, 'setPer' => 3),
            array('name' => '零点料位','id'=> 'hopperZero', 'unit' => 'g', 'dispPer' => 3, 'setPer' => 3),
            array('name' => '加料延时','id'=> 'wgtPeakDis', 'unit' => 's', 'dispPer' => 3, 'setPer' => 3),
            array('name' => '挤出机加速时间','id'=> 'extrTime', 'unit' => 's', 'dispPer' => 3, 'setPer' => 3),
            array('name' => '','id'=> '', 'unit' => '', 'dispPer' => 1, 'setPer' => 3),
        );
       
        public function status($permission) {
            $count = count($this->data) - 1;
            
            echo '<br/><table class="table table-striped ">';
            for($i=1; $i<$count; $i++) {
                if (isset($this->data[$i]['title'])) {
                    echo '<tr class="ttitle"><td style="background-color: #0D7DCB;">'.
                        $this->data[$i]['title'].
                        '</td><td style="background-color: #0D7DCB;"></td></tr>';
                    continue;
                }
                if (isset($this->data[$i]['divider'])) {
                    echo '<tr style="border-bottom:2px solid #0D7DCB !important">';
                } else {
                    echo '<tr>';
                }
                echo '<td class="argName">'.($this->data[$i]['name']).':</td>'.
                    '<td><span id="'.($this->data[$i]['id']).'" class="argValue">value</span><span class="unit"> '.
                    ($this->data[$i]['unit']).'</span>'.
                    ($this->data[$i]['setable']&&($_SESSION['permission'] >= @$this->data[$i]['setper'])?
                    '<span class="pull-right">&nbsp;&nbsp;<button class="btn btn-primary btn-small" type="button" data-toggle="modal">'.
                    $this->data[$i]['btn'].'</button></span>':"").'</td></tr>';
            }
            echo '</table>';
        }
        
        public function alert() {
            echo '<table id="alerts" class="table table-striped ">';
            echo '</table>';
        }
        
        public function args($permission) {
            $count = count($this->args) - 1;
        
            echo '<br/><table class="table table-striped" ><tbody>';
            for($i=0; $i<$count; $i++) {
                 if (isset($this->args[$i]['title'])) {
                    if ($_SESSION['permission'] >= $this->args[$i]['dispPer']) {
                        echo '<tr class="ttitle"><td style="background-color: #0D7DCB;">'.
                            $this->args[$i]['title'].
                            '</td><td style="background-color: #0D7DCB;"></td></td><td style="background-color: #0D7DCB;"></td></tr>';
                    }
                    continue;
                }
                if ($_SESSION['permission'] >= $this->args[$i]['dispPer']) {
                    if (isset($this->args[$i]['divider'])) {
                        echo '<tr style="border-bottom:2px solid #0D7DCB !important"';
                    } else {
                        echo '<tr';
                    }
                    
                    echo ' id="'.($this->args[$i]['id']).
                    '"><td class="argName">'.($this->args[$i]['name']).':</td>'.
                    '<td><span class="argValue">value</span> '.($this->args[$i]['unit']).
                    '<span></span></td><td width="20%">';
                    if ($_SESSION['permission'] >= $this->args[$i]['setPer']) {
                        echo '<button class="btn btn-primary btn-small pull-right" type="button" data-toggle="modal" onClick="javascript:updateArg(\''.
                                ($this->args[$i]['id']).'\')">修改</button>';
                    }
                    echo '</td></tr>'."\n";
                }
            }
            echo '</tbody></table>';
        }
        
        public function manage($permission) {
            echo '<div style="margin-top:20px; margin-bottom:20px; margin-left:20px;">
                    <a class="btn btn-primary" href="user.php">添加</a>
                  </div>';
            echo '<table id="users" class="table table-striped ">';
            
            echo '</table>';
        }
    }
?>
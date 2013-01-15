<?php
    class Data {
        private $warnings = array(
            '01' => '料斗料位过高',
            '02' => '料斗料位过低',
            '03' => '米重值超上限',
            '04' => '米重值超下限',
            '05' => '挤出量超上限',
            '06' => '挤出量超下限',
            '07' => '物料流量突变',
            '08' => '挤出机转速丢失',
            '09' => '牵引机转速丢失',
            '10' => '机械故障',
            '11' => '固态继电器故障',
            '12' => '重量采集单元故障',
        );
        
        public function getAlerts() {
            $alerts = array();
            for ($i=0; $i<40; $i++) {
                $offset = rand(1, 12);
                $offset = $offset>9?$offset:'0'.$offset;
                $alerts[$i] = array('alert' => $this->warnings[$offset],
                                    'timestamp' => date("Y-m-d H:i:s").' ~ '.date("Y-m-d H:i:s"));
            }
            
            return json_encode($alerts);
        }
        
        public function getStatus() {
            $status = array();
            $demo = new DEMO();
            $count = $demo->getStatusSize();
            for ($i=0; $i<$count; $i++) {
                $status[$i] = $demo->getStatus($i);
            }
            
            return json_encode($status);
        }
        
         public function getArgs() {
            $args = array();
            $demo = new DEMO();
            $count = $demo->getArgsSize();
            for ($i=0; $i<$count; $i++) {
                $args[$i] = $demo->getArg($i);
            }
            
            return json_encode($args);
        }
    }
    
    class DEMO {
        private $data = array(
            array('name' => '米重设定值','id'=> 'setkgPerMeter', 'min' => 15000, 'max' => 15000, 'div' => 10000, 'frac' => 4),
            array('name' => '米重实际值','id'=> 'kgPerMeterShow', 'min' => 14000, 'max' => 15000, 'div' => 10000, 'frac' => 4),
            array('name' => '牵引机机状态','id'=> 'autoManualstateOfDragger', 'min' => 1, 'max' => 1, 'div' => 1),
            array('name' => '挤出量设定值','id'=> 'setWgtPerHour', 'min' => 3505000, 'max' => 3505000, 'div' => 10000, 'frac' => 4),
            array('name' => '挤出量实际值','id'=> 'wgtPerHour', 'min' => 3500000, 'max' => 3505000, 'div' => 10000, 'frac' => 4),
            array('name' => '挤出机状态','id'=> 'autoManualstateOfExtruder', 'min' => 1, 'max' => 1, 'div' => 1),
            array('name' => '挤出率','id'=> 'wgtPerRev', 'min' => 8200, 'max' => 8300, 'div' => 100, 'frac' => 2),
            array('name' => '螺杆速度','id'=> 'speedPerMin', 'min' => 89000, 'max' => 89999, 'div' => 1000, 'frac' => 3),
            array('name' => '牵引速度','id'=> 'meterPerMin', 'min' => 5000, 'max' => 5100, 'div' => 1000, 'frac' => 3),
            array('name' => '给定电压','id'=> 'AIN2Extruder', 'min' => 6900, 'max' => 6900, 'div' => 1),
            array('name' => '输出电压','id'=> 'extrudDect', 'min' => 6800, 'max' => 6900, 'div' => 1),
            array('name' => '给定电压','id'=> 'AIN1Drager', 'min' => 7800, 'max' => 7800, 'div' => 1),
            array('name' => '输出电压','id'=> 'dragerDect', 'min' => 7700, 'max' => 7800, 'div' => 1),
            array('name' => '累计挤出量','id'=> 'wgtPerHourAddup', 'min' => 10000, 'max' => 12000, 'div' => 10, 'frac' => 1),
            array('name' => '累计长度','id'=> 'meterAddup', 'min' => 10000, 'max' => 15000, 'div' => 10, 'frac' => 1),
            array('name' => '','id'=> '', 'min' => '', 'max' => FALSE, 'div' => 1),);
        
        private $args = array(
            array('name' => '过滤系数','id'=> 'ExtrAlgLen', 'value' => 100, 'permission' => 0),
            array('name' => '控制系数','id'=> 'ExtrAlgLendis', 'value' => 3, 'permission' => 0, 'divider' => TRUE),
            array('name' => 'P参数','id'=> 'extrpGain', 'value' => 300, 'permission' => 0),
            array('name' => 'I参数 ','id'=> 'extriGain', 'value' => 300, 'permission' => 0),
            array('name' => 'P控制死区','id'=> 'extrDeadBand', 'value' => 5, 'permission' => 0, 'divider' => TRUE),
            array('name' => '挤出量报警上限','id'=> 'WgtPerHWarnUp', 'value' => 0.2, 'permission' => 0),
            array('name' => '挤出量报警下限','id'=> 'WgtPerHWarnDw', 'value' => 0.2, 'permission' => 0, 'divider' => TRUE),
            array('name' => '最小转度','id'=> 'extrMinSpeed', 'value' => 1, 'permission' => 0),
            array('name' => '最大转速','id'=> 'maxSpdPerMin', 'value' => 120, 'permission' => 0, 'divider' => TRUE),
            array('name' => '零点死区','id'=> 'extrZeroDeadband', 'value' => 327702, 'permission' => 0, 'divider' => TRUE),
            array('name' => '过滤系数','id'=> 'calFrq', 'value' => 30, 'permission' => 0),
            array('name' => '控制系数','id'=> 'calFrqdis', 'value' => 3, 'permission' => 0, 'divider' => TRUE),
            array('name' => 'P参数','id'=> 'dragpGain', 'value' => 100, 'permission' => 0),
            array('name' => 'I参数 ','id'=> 'dragiGain', 'value' => 150, 'permission' => 0),
            array('name' => 'P控制死区','id'=> 'dragDeadBand', 'value' => 5, 'permission' => 0, 'divider' => TRUE),
            array('name' => '米重值报警上限','id'=> 'kgPerMeterWarnUp', 'value' => 1, 'permission' => 0),
            array('name' => '米重值报警下限','id'=> 'kgPerMeterWarnDw', 'value' => 1, 'permission' => 0, 'divider' => TRUE),
            array('name' => '最小牵引速度','id'=> 'dragMinSpeed', 'value' => 0.1, 'permission' => 0),
            array('name' => '最大牵引速度','id'=> 'dragHighScope', 'value' => 9, 'permission' => 0, 'divider' => TRUE),
            array('name' => '零点死区','id'=> 'dragZeroDeadband', 'value' => 327702, 'permission' => 0, 'divider' => TRUE),
            array('name' => '系统运行模式','id'=> 'systemRunMode', 'value' => 3342341, 'permission' => 0),
            array('name' => '传感器系数','id'=> 'digitPerG', 'value' => 21700, 'permission' => 0),
            array('name' => '米重显示系数','id'=> 'WgtPerMShLen', 'value' => 2, 'permission' => 0, 'divider' => TRUE),
            array('name' => '料斗低料位','id'=> 'hopper20', 'value' => 5200, 'permission' => 0),
            array('name' => '报警料斗低料位','id'=> 'hopper20Warn', 'value' => 3200, 'permission' => 0),
            array('name' => '料斗高料位','id'=> 'hopper80', 'value' => 89000, 'permission' => 0),
            array('name' => '报警料斗高料位','id'=> 'hopper80Warn', 'value' => 9800, 'permission' => 0),
            array('name' => '零点料位','id'=> 'hopperZero', 'value' => 1900, 'permission' => 0),
            array('name' => '加料后计算重量延迟','id'=> 'wgtPeakDis', 'value' => 20, 'permission' => 0),
            array('name' => '挤出机加速时间','id'=> 'extrTime', 'value' => 320, 'permission' => 0),
            array('name' => '','id'=> '', 'value' => '', 'permission' => 0),
        );
        
        private $users = array(
            array('name' => 'admin','id'=> '', 'permission' => 0),
            array('name' => 'test1','id'=> '', 'permission' => 0),
            array('name' => 'test2','id'=> '', 'permission' => 0),
            array('name' => 'test3','id'=> '', 'permission' => 0),
            array('name' => '','id'=> '', 'permission' => 0),
        );
        
        public function getStatusSize() {
            return count($this->data) - 1;
        }
        
        public function getStatus($index) {
            if (isset($this->data[$index]['frac'])) {
                $value = sprintf("%.".$this->data[$index]['frac']."f",
                 rand($this->data[$index]['min'], $this->data[$index]['max'])/$this->data[$index]['div']);
            } else {
                $value = rand($this->data[$index]['min'], $this->data[$index]['max'])/$this->data[$index]['div'];
            }
            return array('id' => $this->data[$index]['id'],
                         'value' => $value);
        }
        
        public function getArgsSize() {
            return count($this->args) - 1;
        }
        
        public function getArg($index) {
            return array('id' => $this->args[$index]['id'],
                         'value' => $this->args[$index]['value']);
        }
        
        public function getUserSize() {
            return count($this->users) - 1;
        }
    }
?>
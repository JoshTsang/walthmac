<?php
    class Data {
        public function getAlerts() {
            $alerts = array();
            for ($i=0; $i<40; $i++) {
                $alerts[$i] = array('alert' => "这是随机生成的错误信息".rand(0, 1000),
                                    'timestamp' => date("Y-m-d H:i:s"));
            }
            
            return json_encode($alerts);
        }
    }
?>
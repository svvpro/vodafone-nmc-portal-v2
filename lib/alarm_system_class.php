<?php
require_once "base_class.php";
class AlarmSystem extends Base{
    public function __construct($db){
        parent::__construct("alarm_system", $db);
    }
}
?>
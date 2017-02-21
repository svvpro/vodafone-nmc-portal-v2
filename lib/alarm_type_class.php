<?php
require_once "base_class.php";
class AlarmType extends Base{
    public function __construct($db){
        parent::__construct("alarm_type", $db);
    }
}
?>
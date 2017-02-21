<?php
require_once "base_class.php";
class AlarmTypeAgree extends Base{
    public function __construct($db){
        parent::__construct("alarm_type_agree", $db);
    }
}
?>
<?php
require_once "base_class.php";
class TypeTemplate extends Base{
    public function __construct($db){
        parent::__construct("alarm_type_template", $db);
    }
}
?>
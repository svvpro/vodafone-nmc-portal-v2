<?php
require_once "base_class.php";

class AlarmTemplate extends Base
{
    public function __construct($db)
    {
        parent::__construct("alarm_text", $db);
    }
}

?>
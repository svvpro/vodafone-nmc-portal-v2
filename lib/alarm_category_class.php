<?php
require_once "base_class.php";

class AlarmCategory extends Base
{
    public function __construct($db)
    {
        parent::__construct("alarm_category", $db);
    }
}

?>
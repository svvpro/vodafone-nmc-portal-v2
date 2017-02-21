<?php
require_once "base_class.php";

class ServiceCodeType extends Base
{
    public function __construct($db)
    {
        parent::__construct("service_code_type", $db);
    }
}

?>
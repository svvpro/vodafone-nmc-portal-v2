<?php
require_once "base_class.php";

class ServiceCodeDescription extends Base
{
    public function __construct($db)
    {
        parent::__construct("service_code_description", $db);
    }
}

?>
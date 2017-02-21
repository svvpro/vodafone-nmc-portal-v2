<?php
require_once "base_class.php";

class IngenerDepartament extends Base
{
    public function __construct($db)
    {
        parent::__construct("ingener_departament", $db);
    }
}

?>
<?php
require_once "base_class.php";

class IngenerContact extends Base
{
    public function __construct($db)
    {
        parent::__construct("ingener_contact", $db);
    }
}

?>
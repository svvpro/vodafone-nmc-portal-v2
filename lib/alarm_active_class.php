<?php
require_once "base_class.php";

class AlarmActive extends Base
{
    public function __construct($db)
    {
        parent::__construct("alarm_active", $db);
    }

   public function get($id){
       return json_encode($this->freeQuery("SELECT * FROM alarm_active WHERE id = $id"));
   }


}

?>
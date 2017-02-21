<?php
require_once "base_class.php";

class AlarmArchive extends Base
{
    public function __construct($db)
    {
        parent::__construct("alarm_archive", $db);
    }


    public function alarmClose($data)
    {
        $this->freeQueryUpdate(array(
            'text_close'=>$data['text_close'],
            'category_id'=>$data['category_id'],
            'system_id'=>$data['system_id'],
            'date_close'=>$data['date_close'],
            'close_id'=>0,
        ), "`close_id`=".$data['close_id']);
    }

    public function alarmCloseWithComment($data)
    {
        $this->freeQueryUpdate(array(
            'text_close'=>$data['text_close'],
            'category_id'=>$data['category_id'],
            'system_id'=>$data['system_id'],
            'date_close'=>$data['date_close'],
            'comment'=>$data['comment'],
            'close_id'=>0,
        ), "`close_id`=".$data['close_id']);
    }

    public function getDataForYearChart()
    {

    }

}

?>
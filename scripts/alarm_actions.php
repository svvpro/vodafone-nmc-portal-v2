<?php


//function get_alarm($alarm_active){
//    $alarm_active->getAllFromCurrentTable();
//}

function get_alarm($db)
{
    $db->freeQuery("SELECT
	active.id AS id,
	active.ingener AS ingener,
	active.text AS text,
	active.part AS part,
	active.next_status AS next_status,
	active.system_id AS system_id,
	system.title AS system,
	category.title AS category,
	active.close_id AS close_id,
	active.type_id AS type_id
FROM
	alarm_active AS active,
	alarm_system AS system,
	alarm_type AS category
WHERE
	active.system_id = system.id 
AND active.type_id = category.id");
}

function get_alarm_by_id($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->get($data->type_id);
}

function add_alarm($alarm_active, $alarm_archive)
{
    $data = json_decode(file_get_contents("php://input"));
    if ($data->type_id == 1){
        $alarm_archive->add(array(
            'text_open' => $data->text,
            'text_close' => $data->text,
            'date_open' => $data->open_close,
            'date_close' => $data->open_close,
            'category_id' => $data->category_id,
            'system_id' => $data->system_id,
            'close_id' => 0
        ));
    }else{
        $close_id = $alarm_active->randomString();

        $alarm_active->add(array(
            'type_id' => $data->type_id,
            'ingener' => $data->ingener,
            'text' => $data->text,
            'next_status' => $data->next_status,
            'system_id' => $data->system_id,
            'close_id' => $close_id
        ));

        $alarm_archive->add(array(
            'text_open' => $data->text,
            'date_open' => $data->open_close,
            'category_id' => $data->category_id,
            'system_id' => $data->system_id,
            'close_id' => $close_id
        ));
    }
}


function delete_alarm($alarm_active, $alarm_archive)
{
    $data = json_decode(file_get_contents("php://input"));
    $alarm_active->delete($data->id);
    $alarm_archive->alarmClose(array(
        'text_close' => $data->text,
        'date_close' => $data->date_close,
        'system_id' => $data->system_id,
        'category_id' => $data->category_id,
        'close_id' => $data->close_id,
    ));
}


function edit_alarm($alarm_active)
{
    $data = json_decode(file_get_contents("php://input"));
    $alarm_active->get($data->id);
}

function update_alarm($alarm_active, $alarm_archive)
{
    $data = json_decode(file_get_contents("php://input"));

//    Предаварийная ситуация->Кат.3
    if ($data->type_id == 5) {
        $alarm_archive->alarmCloseWithComment(array(
            'text_close' => $data->text,
            'date_close' => $data->open_close,
            'system_id' => $data->system_id,
            'category_id' => 1,
            'comment' => '->Кат.3',
            'close_id' => $data->close_id,
        ));
        $alarm_active->update($data->id, array(
            'type_id' => 8,
            'ingener' => $data->ingener,
            'text' => $data->text,
            'part' => 0,
            'next_status' => $data->next_status,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id
        ));
        $alarm_archive->add(array(
            'text_open' => $data->text,
            'date_open' => $data->open_close,
            'category_id' => 2,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id,
            'comment' => 'Предаварийная ситуация->Кат.3'
        ));
//    Предаварийная ситуация->Кат.2
    } else if ($data->type_id == 6) {
        $alarm_archive->alarmClose(array(
            'text_close' => $data->text,
            'date_close' => $data->open_close,
            'system_id' => $data->system_id,
            'category_id' => 1,
            'comment' => '->Кат.2',
            'close_id' => $data->close_id,
        ));
        $alarm_active->update($data->id, array(
            'type_id' => 13,
            'ingener' => $data->ingener,
            'text' => $data->text,
            'part' => 0,
            'next_status' => $data->next_status,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id
        ));
        $alarm_archive->add(array(
            'text_open' => $data->text,
            'date_open' => $data->open_close,
            'category_id' => 3,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id,
            'comment' => 'Предаварийная ситуация->Кат.2'
        ));
//    Предаварийная ситуация->Кат.1
    } else if ($data->type_id == 7) {
        $alarm_archive->alarmClose(array(
            'text_close' => $data->text,
            'date_close' => $data->open_close,
            'system_id' => $data->system_id,
            'category_id' => 1,
            'comment' => '->Кат.1',
            'close_id' => $data->close_id,
        ));
        $alarm_active->update($data->id, array(
            'type_id' => 18,
            'ingener' => $data->ingener,
            'text' => $data->text,
            'part' => 0,
            'next_status' => $data->next_status,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id
        ));
        $alarm_archive->add(array(
            'text_open' => $data->text,
            'date_open' => $data->open_close,
            'category_id' => 4,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id,
            'comment' => 'Предаварийная ситуация->Кат.1'
        ));
//    Кат.3->Кат.2
    } else if ($data->type_id == 11) {
        $alarm_archive->alarmClose(array(
            'text_close' => $data->text,
            'date_close' => $data->open_close,
            'system_id' => $data->system_id,
            'category_id' => 2,
            'comment' => '->Кат.2',
            'close_id' => $data->close_id,
        ));
        $alarm_active->update($data->id, array(
            'type_id' => 13,
            'ingener' => $data->ingener,
            'text' => $data->text,
            'part' => 0,
            'next_status' => $data->next_status,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id
        ));
        $alarm_archive->add(array(
            'text_open' => $data->text,
            'date_open' => $data->open_close,
            'category_id' => 3,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id,
            'comment' => 'Кат.3->Кат.2'
        ));
//    Кат.3->Кат.1
    } else if ($data->type_id == 12) {
        $alarm_archive->alarmClose(array(
            'text_close' => $data->text,
            'date_close' => $data->open_close,
            'system_id' => $data->system_id,
            'category_id' => 2,
            'comment' => '->Кат.1',
            'close_id' => $data->close_id,
        ));
        $alarm_active->update($data->id, array(
            'type_id' => 18,
            'ingener' => $data->ingener,
            'text' => $data->text,
            'part' => 0,
            'next_status' => $data->next_status,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id
        ));
        $alarm_archive->add(array(
            'text_open' => $data->text,
            'date_open' => $data->open_close,
            'category_id' => 4 ,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id,
            'comment' => 'Кат.3->Кат.1'
        ));
//    Кат.2->Кат.1
    } else if ($data->type_id == 16) {
        $alarm_archive->alarmClose(array(
            'text_close' => $data->text,
            'date_close' => $data->open_close,
            'system_id' => $data->system_id,
            'category_id' => 3,
            'comment' => '->Кат.1',
            'close_id' => $data->close_id,
        ));
        $alarm_active->update($data->id, array(
            'type_id' => 18,
            'ingener' => $data->ingener,
            'text' => $data->text,
            'part' => 0,
            'next_status' => $data->next_status,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id
        ));
        $alarm_archive->add(array(
            'text_open' => $data->text,
            'date_open' => $data->open_close,
            'category_id' => 4 ,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id,
            'comment' => 'Кат.2->Кат.1'
        ));
//    Кат.2->Кат.3
    } else if ($data->type_id == 17) {
        $alarm_archive->alarmClose(array(
            'text_close' => $data->text,
            'date_close' => $data->open_close,
            'system_id' => $data->system_id,
            'category_id' => 3,
            'comment' => '->Кат.3',
            'close_id' => $data->close_id,
        ));
        $alarm_active->update($data->id, array(
            'type_id' => 8,
            'ingener' => $data->ingener,
            'text' => $data->text,
            'part' => 0,
            'next_status' => $data->next_status,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id
        ));
        $alarm_archive->add(array(
            'text_open' => $data->text,
            'date_open' => $data->open_close,
            'category_id' => 2,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id,
            'comment' => 'Кат.2->Кат.3'
        ));
//    Кат.1->Кат.2
    } else if ($data->type_id == 21) {
        $alarm_archive->alarmClose(array(
            'text_close' => $data->text,
            'date_close' => $data->open_close,
            'system_id' => $data->system_id,
            'category_id' => 4,
            'comment' => '->Кат.2',
            'close_id' => $data->close_id,
        ));
        $alarm_active->update($data->id, array(
            'type_id' => 13,
            'ingener' => $data->ingener,
            'text' => $data->text,
            'part' => 0,
            'next_status' => $data->next_status,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id
        ));
        $alarm_archive->add(array(
            'text_open' => $data->text,
            'date_open' => $data->open_close,
            'category_id' => 3,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id,
            'comment' => 'Кат.1->Кат.2'
        ));

//    Кат.1->Кат.3
    } else if ($data->type_id == 22) {
        $alarm_archive->alarmClose(array(
            'text_close' => $data->text,
            'date_close' => $data->open_close,
            'system_id' => $data->system_id,
            'category_id' => 4,
            'comment' => '->Кат.3',
            'close_id' => $data->close_id,
        ));
        $alarm_active->update($data->id, array(
            'type_id' => 8,
            'ingener' => $data->ingener,
            'text' => $data->text,
            'part' => 0,
            'next_status' => $data->next_status,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id
        ));
        $alarm_archive->add(array(
            'text_open' => $data->text,
            'date_open' => $data->open_close,
            'category_id' => 2,
            'system_id' => $data->system_id,
            'close_id' => $data->close_id,
            'comment' => 'Кат.1->Кат.3'
        ));
    } else {
        $alarm_active->update($data->id, array(
            'type_id' => $data->type_id,
            'ingener' => $data->ingener,
            'text' => $data->text,
            'part' => $data->part,
            'next_status' => $data->next_status,
            'system_id' => $data->system_id
        ));
    }
}

function select_system($db)
{
    $db->getAllFromTable('alarm_system');
}

function select_type_category($db)
{
    $db->getAllFromTable('alarm_type');
}

function select_contact($db)
{
    $db->getAllFromTable('ingener_contact');
}

?>
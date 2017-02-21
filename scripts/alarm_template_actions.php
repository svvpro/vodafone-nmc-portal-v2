<?php

function get_template($db)
{
    $db->freeQuery("SELECT
	tx.id AS id,
	s.title AS system,
	ty.title AS type,
    ta.title AS type_agree,
	tx.text AS text,
	tx.language AS language
FROM
	alarm_system AS s,
	alarm_type_template AS ty,
    alarm_type_agree AS ta,
	alarm_text AS tx
WHERE
	s.id = tx.system_id
AND ty.id = tx.type_id
AND ta.id = tx.type_agree_id");
}

function add_template($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->add(array(
        'text' => $data->text,
        'system_id' => $data->system_id,
        'type_id' => $data->type_id,
        'type_agree_id' => $data->type_agree_id,
        'language' => $data->language
    ));
}

function delete_template($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->delete($data->id);
}

function edit_template($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->get($data->id);
}

function update_template($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->update($data->id, array(
        'text' => $data->text,
        'system_id' => $data->system_id,
        'type_id' => $data->type_id,
        'type_agree_id' => $data->type_agree_id
    ));
}


function select_type_template($db)
{
    $db->getAllFromTable('alarm_type_template');
}

function select_type_agree($db)
{
    $db->getAllFromTable('alarm_type_agree');
}


?>
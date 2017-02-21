<?php

function get_servicecode_description($db)
{
    $db->freeQuery("
SELECT
	scd.id AS id,
	sct.title AS service,
	scd.service_code_id AS code_id,
	scd.title AS description
FROM
	service_code_description AS scd,
	service_code_type AS sct
WHERE
	scd.service_code_type_id = sct.id");
}

function add_servicecode_description($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->add(array(
        'service_code_id' => $data->service_code_id,
        'title' => $data->title,
        'service_code_type_id' => $data->service_code_type_id
    ));
}

function delete_servicecode_description($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->delete($data->id);
}

function edit_servicecode_description($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->get($data->id);
}

function update_servicecode_description($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->update($data->id, array(
        'service_code_id' => $data->service_code_id,
        'title' => $data->title,
        'service_code_type_id' => $data->service_code_type_id
    ));
}

function select_service_code_type($db)
{
    $db->getAllFromTable('service_code_type');
}
?>
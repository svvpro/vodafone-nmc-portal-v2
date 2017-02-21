<?php
function get_type($db)
{
    $db->freeQuery("
    SELECT
	        type.id AS id,
	        type.title AS title,
	        type.mail AS mail,
	        type.bottom AS bottom,
	        category.title AS category,
	        type.ordering AS ordering 
    FROM
	        alarm_type AS type,
	        alarm_category AS category
    WHERE
	        type.category_id = category.id");
}


function add_type($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->add(array(
        'title'=>$data->title,
        'mail'=>$data->mail,
        'bottom'=>$data->bottom,
        'category_id'=>$data->category_id,
        'is_close'=> 0
    ));
}

function delete_type($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->delete($data->id);
}

function edit_type($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->get($data->id);
}

function update_type($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->update($data->id, array(
        'title'=>$data->title,
        'mail'=>$data->mail,
        'bottom'=>$data->bottom,
        'category_id'=>$data->category_id
    ));
}

function select_category($db)
{
    $db->getAllFromTable('alarm_category');
}
?>
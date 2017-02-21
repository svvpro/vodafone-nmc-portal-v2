<?php
function get_servicecode_type($db){
    $db->getAllFromCurrentTable();
}

function add_servicecode_type($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->add(array('title'=>$data->title));
}

function delete_servicecode_type($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->delete($data->id);
}

function edit_servicecode_type($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->get($data->id);
}

function update_servicecode_type($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->update($data->id, array('title'=>$data->title));
}
?>
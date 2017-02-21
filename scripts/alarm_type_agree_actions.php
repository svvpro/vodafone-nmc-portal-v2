<?php
function get_type_agree($db){
    $db->getAllFromCurrentTable();
}

function add_type_agree($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->add(array('title'=>$data->title));
}

function delete_type_agree($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->delete($data->id);
}

function edit_type_agree($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->get($data->id);
}

function update_type_agree($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->update($data->id, array('title'=>$data->title));
}
?>
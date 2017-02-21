<?php
function get_system($db){
    $db->getAllFromCurrentTable();
}

function add_system($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->add(array('title'=>$data->title));
}

function delete_system($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->delete($data->id);
}

function edit_system($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->get($data->id);
}

function update_system($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->update($data->id, array('title'=>$data->title));
}
?>
<?php
function get_depart($db){
    $db->getAllFromCurrentTable();
}

function add_depart($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->add(array('title'=>$data->title));
}

function delete_depart($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->delete($data->id);
}

function edit_depart($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->get($data->id);
}

function update_depart($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->update($data->id, array('title'=>$data->title));
}
?>
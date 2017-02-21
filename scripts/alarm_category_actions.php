<?php
function get_category($db){
    $db->getAllFromCurrentTable();
}

function add_category($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->add(array('title'=>$data->title));
}

function delete_category($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->delete($data->id);
}

function edit_category($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->get($data->id);
}

function update_category($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->update($data->id, array('title'=>$data->title));
}
?>
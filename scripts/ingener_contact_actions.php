<?php

function get_contact($db)
{
    $db->freeQuery("SELECT contact.id as id, 
                           contact.name as name,
                           contact.surname as surname,  
                           contact.name_in_template as name_in_template,
                           contact.pbx as pbx, 
                           contact.phone as phone, 
                           contact.mail as mail, 
                           depart.title as departament
                   FROM ingener_contact as contact, 
                        ingener_departament as depart
                   WHERE contact.departament_id = depart.id");
}

function add_contact($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->add(array(
        'surname' => $data->surname,
        'name' => $data->name,
        'name_in_template' => $data->name_in_template,
        'pbx' => $data->pbx,
        'phone' => $data->phone,
        'mail' => $data->mail,
        'departament_id ' => $data->departament_id
    ));
}

function delete_contact($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->delete($data->id);
}

function edit_contact($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->get($data->id);
}

function update_contact($db)
{
    $data = json_decode(file_get_contents("php://input"));
    $db->update($data->id, array(
        'surname' => $data->surname,
        'name' => $data->name,
        'name_in_template' => $data->name_in_template,
        'pbx' => $data->pbx,
        'phone' => $data->phone,
        'mail' => $data->mail,
        'departament_id ' => $data->departament_id
    ));
}

function select_departament($db)
{
    $db->getAllFromTable('ingener_departament');
}
?>
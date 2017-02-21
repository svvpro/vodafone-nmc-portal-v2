<?php
include('scripts/alarm_actions.php');
include('scripts/alarm_archive_actions.php');
include('scripts/alarm_template_actions.php');
include('scripts/alarm_system_actions.php');
include('scripts/alarm_category_actions.php');
include('scripts/alarm_type_actions.php');
include('scripts/alarm_type_agree_actions.php');
include('scripts/alarm_type_template_actions.php');
include('scripts/ingener_departament_actions.php');
include('scripts/ingener_contact_actions.php');
include('scripts/servicecode_description_actions.php');
include('scripts/servicecode_type_actions.php');

require_once "lib/database_class.php";

require_once "lib/alarm_active_class.php";
require_once "lib/alarm_archive_class.php";
require_once "lib/alarm_template_class.php";
require_once "lib/alarm_system_class.php";
require_once "lib/alarm_category_class.php";
require_once "lib/alarm_type_class.php";
require_once "lib/alarm_type_agree_class.php";
require_once "lib/alarm_type_template_class.php";
require_once "lib/ingener_departament_class.php";
require_once "lib/ingener_contact_class.php";
require_once "lib/servicecode_description_class.php";
require_once "lib/servicecode_type_class.php";


$db = new DataBase();
$alarm_active =  new AlarmActive($db);
$alarm_archive =  new AlarmArchive($db);
$system =  new AlarmSystem($db);
$category = new AlarmCategory($db);
$type_template = new TypeTemplate($db);
$departament = new IngenerDepartament($db);
$contact = new IngenerContact($db);
$alarm_type = new AlarmType($db);
$alarm_type_agree = new AlarmTypeAgree($db);
$alarm_template = new AlarmTemplate($db);
$servicecode_description = new ServiceCodeDescription($db);
$servicecode_type = new ServiceCodeType($db);


switch($_GET['action']) {
    //  Alarm routs
    case 'get_alarm' :
        get_alarm($alarm_active);
        break;
    case 'add_alarm' :
        add_alarm($alarm_active, $alarm_archive);
        break;
    case 'delete_alarm' :
        delete_alarm($alarm_active, $alarm_archive);
        break;
    case 'edit_alarm' :
        edit_alarm($alarm_active);
        break;
    case 'update_alarm' :
        update_alarm($alarm_active, $alarm_archive);
        break;
    case 'get_alarm_by_id' :
        edit_alarm($alarm_type);
        break;

    //  Alarm archive routs
    case 'get_archive' :
        get_archive($alarm_archive);
        break;
//    case 'add_archive' :
//        add_archive($alarm_archive);
//        break;
    case 'delete_archive' :
        delete_archive($alarm_archive);
        break;
    case 'edit_archive' :
        edit_archive($alarm_archive);
        break;
    case 'update_archive' :
        update_archive($alarm_archive);
        break;
    case 'post_archive' :
        post_archive($alarm_archive);
        break;
    case 'system_chart' :
        system_chart($alarm_archive);
        break;
    case 'category_chart' :
        category_chart($alarm_archive);
        break;
    case 'year_chart' :
        year_chart($alarm_archive);
        break;

//  Alarm template routs
    case 'get_template' :
        get_template($alarm_template);
        break;
    case 'add_template' :
        add_template($alarm_template);
        break;
    case 'delete_template' :
        delete_template($alarm_template);
        break;
    case 'edit_template' :
        edit_template($alarm_template);
        break;
    case 'update_template' :
        update_template($alarm_template);
        break;
    
//   Selection routs
    case 'select_system' :
        select_system($system);
        break;
    case 'select_type_template' :
        select_type_template($alarm_template);
        break;
    case 'select_type_agree' :
        select_type_agree($alarm_type_agree);
        break;
    case 'select_type_category' :
        select_type_category($alarm_type);
        break;

    case 'select_contact' :
        select_contact($contact);
        break;
        
 
    
//    System routs    
    case 'get_system' :
        get_system($system);
        break;
    case 'add_system' :
        add_system($system);
        break;
    case 'delete_system' :
        delete_system($system);
        break;
    case 'edit_system' :
        edit_system($system);
        break;
    case 'update_system' :
        update_system($system);
        break;

//    Category routs
    case 'get_category' :
        get_category($category);
        break;
    case 'add_category' :
        add_category($category);
        break;
    case 'delete_category' :
        delete_category($category);
        break;
    case 'edit_category' :
        edit_category($category);
        break;
    case 'update_category' :
        update_category($category);
        break;

//    Type Template routs
    case 'get_type_template' :
        get_type_template($type_template);
        break;
    case 'add_type_template' :
        add_type_template($type_template);
        break;
    case 'delete_type_template' :
        delete_type_template($type_template);
        break;
    case 'edit_type_template' :
        edit_type_template($type_template);
        break;
    case 'update_type_template' :
        update_type_template($type_template);
        break;

 //    Type Agree Template routs
    case 'get_type_agree' :
        get_type_agree($alarm_type_agree) ;
        break;
    case 'add_type_agree' :
        add_type_agree($alarm_type_agree);
        break;
    case 'delete_type_agree' :
        delete_type_agree($alarm_type_agree);
        break;
    case 'edit_type_agree' :
        edit_type_agree($alarm_type_agree);
        break;
    case 'update_type_agree' :
        update_type_agree($alarm_type_agree);
        break;

//   Alarm Type routs
     case 'add_type' :
        add_type($alarm_type);
        break;
    case 'get_type' :
        get_type($alarm_type);
        break;
    case 'edit_type' :
        edit_type($alarm_type);
        break;
    case 'delete_type' :
        delete_type($alarm_type);
        break;
    case 'update_type' :
        update_type($alarm_type);
        break;
    case 'select_category' :
        select_category($alarm_type);
        break;

//    Department routs
    case 'get_depart' :
        get_depart($departament);
        break;
    case 'add_depart' :
        add_depart($departament);
        break;
    case 'delete_depart' :
        delete_depart($departament);
        break;
    case 'edit_depart' :
        edit_depart($departament);
        break;
    case 'update_depart' :
        update_depart($departament);
        break;
   
    //    Contact routs
    case 'get_contact' :
        get_contact($contact);
        break;
    case 'add_contact' :
        add_contact($contact);
        break;
    case 'delete_contact' :
        delete_contact($contact);
        break;
    case 'edit_contact' :
        edit_contact($contact);
        break;
    case 'update_contact' :
        update_contact($contact);
        break;
    case 'select_depart' :
        select_departament($contact);
        break;

    //    ServiceCode description routs
    case 'get_servicecode_description' :
        get_servicecode_description($servicecode_description);
        break;
    case 'add_servicecode_description' :
        add_servicecode_description($servicecode_description);
        break;
    case 'delete_servicecode_description' :
        delete_servicecode_description($servicecode_description);
        break;
    case 'edit_servicecode_description' :
        edit_servicecode_description($servicecode_description);
        break;
    case 'update_servicecode_description' :
        update_servicecode_description($servicecode_description);
        break;
    case 'select_service_code_type' :
        select_service_code_type($servicecode_description);
        break;

    //    ServiceCode type routs
    case 'get_servicecode_type' :
        get_servicecode_type($servicecode_type);
        break;
    case 'add_servicecode_type' :
        add_servicecode_type($servicecode_type);
        break;
    case 'delete_servicecode_type' :
        delete_servicecode_type($servicecode_type);
        break;
    case 'edit_servicecode_type' :
        edit_servicecode_type($servicecode_type);
        break;
    case 'update_servicecode_type' :
        update_servicecode_type($servicecode_type);
        break;
}
?>
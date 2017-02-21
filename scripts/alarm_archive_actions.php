<?php

function post_archive($db){
    $data = json_decode(file_get_contents("php://input"));
    $from = $data->from;
    $to = $data->to;

    $db->freeQuery("SELECT
	a.id AS id,
	s.title AS system,
	c.title AS category,
	a.text_open AS text_open,
	a.text_close AS text_close,
	a.comment AS comment,
	a.date_open AS date_open,
	a.date_close AS date_close
FROM
	alarm_archive AS a,
	alarm_system AS s,
	alarm_category AS c
WHERE
	a.system_id = s.id
    AND a.category_id = c.id
    AND a.date_open 
BETWEEN '".$from."' AND '".$to."'");
}

function system_chart($db){
    $data = json_decode(file_get_contents("php://input"));
    $from = $data->from;
    $to = $data->to;

    $db->freeQuery("SELECT
	s.title AS label,
	COUNT(s.title) AS value
FROM
	alarm_archive AS a,
	alarm_system AS s,
	alarm_category AS c
WHERE
	a.system_id = s.id
    AND a.category_id = c.id
    AND a.date_open
BETWEEN '".$from."' AND '".$to."' GROUP BY s.title");
}

function category_chart($db){
    $data = json_decode(file_get_contents("php://input"));
    $from = $data->from;
    $to = $data->to;

    $db->freeQuery("SELECT
	c.title AS label,
	COUNT(c.title) AS value
FROM
	alarm_archive AS a,
	alarm_system AS s,
	alarm_category AS c
WHERE
	a.system_id = s.id
    AND a.category_id = c.id
    AND a.date_open 
BETWEEN '".$from."' AND '".$to."' GROUP BY c.title");
}

function year_chart($db){
    $categories = ['Предаварийная ситуация', '3-я категория', '2-я категория', '1-я категория', 'Предаварийное информирование'];

    $result_json =  "{
        'chart': {
            'theme': 'fint',
                'caption': 'Количество аварий за год',
                'subCaption': 'по месяцам',
                'xAxisname': 'Категории',
                'yAxisName': 'Количество аварий',
        },
        'categories': [{'category': [
                    {'label': 'Январь'},
                    {'label': 'Февраль'},
                    {'label': 'Март'},
                    {'label': 'Апрель'},
                    {'label': 'Май'},
                    {'label': 'Июнь'},
                    {'label': 'Июль'},
                    {'label': 'Август'},
                    {'label': 'Сентябрь'},
                    {'label': 'Октябрь'},
                    {'label': 'Ноябрь'},
                    {'label': 'Декабрь'},
            ]
        }],
        'dataset': [";

    for($i = 0; $i < count($categories) ; $i++){
        $month_count =  $db->getDataByYearAndCategory($i+1, 2016);
        $arr = json_encode($month_count, JSON_NUMERIC_CHECK);
        $result_json = $result_json."{'seriesname':'".$categories[$i]."', 'data':".$arr."},";
    }
    $result_json = substr($result_json, 0, -1);
    $result_json = $result_json."]}";
    print_r(json_encode($result_json, JSON_NUMERIC_CHECK));
}

function get_archive($db){
    $db->freeQuery("SELECT
	a.id AS id,
	s.title AS system,
	c.title AS category,
	a.comment AS comment,
	a.text_open AS text_open,
	a.text_close AS text_close,
	a.date_open AS date_open,
	a.date_close AS date_close
FROM
	alarm_archive AS a,
	alarm_system AS s,
	alarm_category AS c
WHERE
	a.system_id = s.id
AND a.category_id = c.id");
}

//function add_depart($db){
//    $data = json_decode(file_get_contents("php://input"));
//    $db->add(array('title'=>$data->title));
//}
//
function delete_archive($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->delete($data->id);
}

function edit_archive($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->get($data->id);
}

function update_archive($db){
    $data = json_decode(file_get_contents("php://input"));
    $db->update($data->id, array(
        'comment'=>$data->comment,
        'system_id'=>$data->system_id,
        'category_id'=>$data->category_id,
        'text_open'=>$data->text_open,
        'text_close'=>$data->text_close,
        'date_open'=>$data->date_open,
        'date_close'=>$data->date_close
    ));
}

//function select_system($db)
//{
//    $db->getAllFromTable('alarm_system');
//}

//function select_type_category($db)
//{
//    $db->getAllFromTable('alarm_type');
//}


?>
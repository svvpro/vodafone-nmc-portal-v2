<?php 
require_once "database_class.php";
require_once "config_class.php";

abstract class Base{
	private $db;
	private $tableName;
	
    protected function __construct($tableName, $db){
		$this->db = $db;
		$this->tableName = $tableName;
	}

	public function freeQuery($query){
		print_r(json_encode($this->db->freeQuery($query), JSON_NUMERIC_CHECK));
	}

    public function getDataByYearAndCategory($category_id, $year)
    {

        $query = "SELECT
                        COUNT(alarm_archive.category_id) AS value
                    FROM
                        months
                    LEFT JOIN alarm_archive ON months.`month` = MONTH (alarm_archive.date_open)
                        AND alarm_archive.category_id = $category_id
                        AND YEAR (alarm_archive.date_open) = $year
                    GROUP BY
                        months.`month`, YEAR (alarm_archive.date_open)
                    ORDER BY months.`month`";

       return $this->db->freeQuery($query);
	}

    public function freeQueryUpdate($updFields, $where){
        $this->db->update($this->tableName, $updFields, $where);
    }
	
	public function getAllFromCurrentTable($order="", $up = true){
		print_r(json_encode($this->db->getAll($this->tableName, $order, $up), JSON_NUMERIC_CHECK));
	}

	public function getAllFromTable($tableName, $order="", $up = true){
		print_r(json_encode($this->db->getAll($tableName, $order, $up)));
	}
	
	public function add($newValues){	
		return $this->db->insert($this->tableName, $newValues);	
	}	
	
	public function get($id){
		print_r(json_encode($this->db->getElementById($this->tableName, $id)));
	}
	
	public function update($id, $updFields){
		return $this->db->updateOnId($this->tableName, $id, $updFields);		
	}
	
	public function delete($id){	
		return $this->db->deleteOnId($this->tableName, $id);
	}

	public function randomString($length = 8) {
        $str = "";
        $characters = array_merge(range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }
	

	
	
	/* -----------------------Not use------------------------------------- */
//	public function getField($fieldOut, $fieldIn, $valueIn){
//		return $this->db->getField($this->tableName, $fieldOut, $fieldIn, $valueIn);
//	}
//	
//	public function getFieldOnId($id, $fieldOut){
//		print_r( json_encode($this->db->getFieldOnId($this->tableName, $id, $fieldOut)));
//	}
//	
//	protected function setFieldOnId($id, $field, $value){
//		return $this->db->setField($this->tableName, $id, $field, $value);
//	}
//	
//	protected function getAllOnField($field, $value, $order = "", $up = true){
//		return $this->db->getAllOnField($this->table_name, $field, $value, $order, $up);
//	}

}

?>
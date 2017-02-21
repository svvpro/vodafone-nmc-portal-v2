<?php 
require_once 'config_class.php';
class DataBase{
	private $config;
	private $mysqli;
	
	public function __construct(){
		$this->config = new Config();
		$this->mysqli = new mysqli($this->config->dbHost, $this->config->dbUser, $this->config->dbPassword, $this->config->dbName);
		/* $this->mysqli->query("SET NAMES 'utf8'"); */
	}
	
	private function query($query){
		return $this->mysqli->query($query);
	}
	
	public function freeQuery($query){
        $resultSet = $this->query($query);
        if(!$resultSet) return false;
        $i = 0;
        $data = array();
        while($row = $resultSet->fetch_assoc()){
            $data[$i] = $row;
            $i++;
        }
        $resultSet->close();
        return $data;
	}
    
	
	public function select($tableName, $fields, $where = "", $order = "", $up = true, $limit=""){
		for($i = 0; $i < count($fields); $i++){
			if($fields[$i] !="*") $fields[$i] = "`".$fields[$i]."`";
		}
		$fields = implode(",", $fields);
		$tableName = $this->config->dbPrefix.$tableName;
		if(!$order) $order = "ORDER BY `id`";
		else {
			if($order != "RAND()"){
				$order = "ORDER BY `$order`";
				if(!$up) $order .= " DESC";
			}
			else $order = "ORDER BY $order";
		}
		if($limit) $limit = "LIMIT $limit";
		if($where) $query = "SELECT $fields FROM $tableName WHERE $where $order $limit";
		else $query = "SELECT $fields FROM $tableName $order $limit";
		$resultSet = $this->query($query);
		if(!$resultSet) return false;
		$i = 0;
        $data = array();
		while($row = $resultSet->fetch_assoc()){
			$data[$i] = $row;
			$i++;
		}
		$resultSet->close();
        return $data;
	}
	
	public function insert($tableName, $newValues){
		$tableName = $this->config->dbPrefix.$tableName;
		$query = "INSERT INTO $tableName (";
		foreach($newValues as $field=>$value) $query .= "`".$field."`,";
		$query = substr($query, 0, -1);
		$query .=") VALUES (";
		foreach($newValues as $value) $query .= "'".addslashes($value)."',";
		$query = substr($query, 0, -1);
		$query .= ")";
		return $this->query($query);
	}
	
	public function update($tableName, $updFields, $where){
		$tableName = $this->config->dbPrefix.$tableName;
		$query = "UPDATE $tableName SET";
		foreach($updFields as $field=>$value) $query .= "`$field` = '".addslashes($value)."',";
		$query = substr($query, 0, -1);
		if($where){
			$query .=" WHERE $where";
			return $this->query($query);
		}else return false;
	}
	
	public function updateOnId($tableName, $id, $updFields){
		return $this->update($tableName, $updFields, "`id`='".addslashes($id)."'");
	}
	
	private function delete($tableName, $where = ""){
		$tableName = $this->config->dbPrefix.$tableName;
		if($where){
			$query = "DELETE FROM $tableName WHERE $where";
			return $this->query($query);
		}else return false;
	}
	
	public function deleteAll($tableName){
		$tableName = $this->config->dbPrefix.$tableName;
		$query = "TRUNCATE TABLE `$tableName`";
		return $this->query($query);
	}
	
	public function getField($tableName, $fieldOut, $fieldIn, $valueIn){
		$data = $this->select($tableName, $fieldOut, "`$fieldIn`='".addslashes($valueIn)."'", "", true, "");
		if(count($data) !=1) return false;
		return $data[0];
	}
	
	public function getFieldOnId($tableName, $id, $fieldOut){
		if(!$this->existId($tableName, $id)) return false;
		return $this->getField($tableName, $fieldOut, "id", $id);
	}
	
	public function getAll($tableName, $order, $up){
		return $this->select($tableName, array("*"), "", $order, $up);
	}
    
	
	public function getAllOnField($tableName, $field, $value, $order, $up){
		return $this->select($tableName, array("*"), "`$field`='".addcslashes($value)."'", $order, $up);
	}
	
	public function deleteOnId($tableName, $id){
		if(!$this->existId($tableName, $id)) return false;
		return $this->delete($tableName, "`id` = '$id'");
	}
	
	public function setField($tableName, $field, $value, $fieldIn, $valueIn){
		if(!$this->existId($tableName, $id)) return false;
		return $this->update($tableName, array($field=>$value), "`$fieldIn`= '".addslashes($valueIn)."'");
	}
	
	public function setFieldOnId($tableName, $id, $field, $value){
		if(!$this->existId($tableName, $id)) return false;
		return $this->setField($tableName, $field, $value, "id", $id);
	}
	
	public function getElementById($tableName, $id){
		if(!$this->existId($tableName, $id)) return false;
		$arr = $this->select($tableName, array("*"), "`id` = '$id'");
		return $arr[0];
	}
	
	public function getRandomElement($tableName, $count){
		return $this->select($tableName, array("*"), "", "RAND()", true, $count);
	}
	
	public function getCount($tableName){
		$data =$this->select($tableName, array("COUNT(`id`)"));
		return $data[0]["COUNT(`id`)"];
	}
	
	public function ifExist($tableName, $field, $value){
		$data = $this->select($tableName, array("id"), "`$field` = '".addslashes($value)."'");
		if(count($data) === 0) return false;
		return true;
	}
	
	private function existId($tableName, $id){
		$data = $this->select($tableName, array("id"), "`id='`".addslashes($id)."'");
		if(count($data) === 0) return false;
		return true;
	}
	
	public function __destruct(){
		if($this->mysqli) $this->mysqli->close();
	}
}	
?>
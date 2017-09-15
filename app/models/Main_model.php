<?php

use Cola\System\Model as Model;
use Cola\Libraries\Database as Database;

class Main_model extends Model {

    function __construct() {
        parent::__construct();
        $this->model = new parent;
    }

    public function sayHello($query) {
        $database = new Database;
        // $result = $database->activeRecord($query);
		$result = $database->select($query);
        return($result);
    }
	
	public function select($columns, $tableName) {
		$database 	= new Database;
		$result 	= $database->select($columns, $tableName);
		
		return($result);
	}
	
	public function insert($tableName, $tableColumns, $insertedColumns) {
		$database 	= new Database;
		$result		= $database->insert($tableName, $tableColumns, $insertedColumns);
		
        return($result);
	}

    public function where($tableName, $tableColumns, $whereIn) {
        $database   = new Database;
        $result     = $database->where($tableName, $tableColumns, $whereIn);
        
        return($result);
    }

    public function update($tableName, $setIn, $whereIn) {
        $database   = new Database;
        $result     = $database->update($tableName, $setIn, $whereIn);

        return($result);
    }

    public function deleted($tableName, $whereIn) {
        $database   = new Database;
        $result     = $database->deleted($tableName, $whereIn);

        return($result);
    }

}
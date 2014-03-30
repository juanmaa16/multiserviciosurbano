<?php

@include_once '../init.php';
@include_once ROOT_DIR . '/conf/conf.php';
@include_once 'mysql_datasource.php';

class Data {

    protected $mysqli;

    public function __construct() {
        $mysqlDataSource = MysqlDataSource::getInstance();
        $this->mysqli = $mysqlDataSource->getMySQLi();
        if (!$this->mysqli->set_charset("utf8")) {
            echo "error loading charset UTF-8 " . $this->mysqli->error;
        }
    }

    public function closeDB() {
        $mysqlDataSource = MysqlDataSource::getInstance();
        $mysqlDataSource->closeConnection();
    }

    protected function prepareStmt($query) {
        return $this->mysqli->prepare($query);
    }

    public function getUltimoID($tabla, $column) {
        $query = "select max($column) as ultimo_id from $tabla";
        $result = $this->mysqli->query($query);
        if (!$result) {
            throw new Exception("Database Error [{$this->mysqli->errno}] {$this->mysqli->error}");
        }
        $row = $result->fetch_assoc();
        $id = $row['ultimo_id'];
        return $id;
    }

    public function realEscapeString($string) {
        return $this->mysqli->real_escape_string($string);
    }

}

?>

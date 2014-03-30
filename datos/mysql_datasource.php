<?php

@include_once '../init.php';
@include_once ROOT_DIR . '/conf/conf.php';

class MysqlDataSource {

    private static $instancia;
    private $mysqli;

    private function __construct() {

        //setea en la session la database
        if (!isset($_SESSION['databaseURL'])) {
            $dbConf = new Configuracion();
            $databaseURL = $dbConf->get_databaseURL();
            $databaseUName = $dbConf->get_databaseUName();
            $databasePWord = $dbConf->get_databasePWord();
            $databaseName = $dbConf->get_databaseName();

            //Set DB Info. in-session
            $_SESSION['databaseURL'] = $databaseURL;
            $_SESSION['databaseUName'] = $databaseUName;
            $_SESSION['databasePWord'] = $databasePWord;
            $_SESSION['databaseName'] = $databaseName;
        }
        $databaseURL = $_SESSION['databaseURL'];
        $databaseUName = $_SESSION['databaseUName'];
        $databasePWord = $_SESSION['databasePWord'];
        $databaseName = $_SESSION['databaseName'];
        $this->mysqli = new mysqli($databaseURL, $databaseUName, $databasePWord, $databaseName);
        if ($this->mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
    }

    public static function getInstance() {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self;
        }
        return self::$instancia;
    }

    public function getMySQLi() {
        if (!isset($this->mysqli)) {
            throw new Exception("no tengo mysqli");
        }
        $this->mysqli->ping();
        return $this->mysqli;
    }

    public function closeConnection() {
        //do nothing for now. pooling may be
//        $this->mysqli->close();
    }

    public function startTransaction() {
        $this->mysqli->autocommit(false);
    }

    public function commitTransaction() {
        $this->mysqli->commit();
    }

    public function rollbackTransaction() {
        $this->mysqli->rollback();
    }

}

?>

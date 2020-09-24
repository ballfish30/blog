<?php

class Controller {
    public $dbhost = 'localhost';
	public $dbuser = 'root';
	public $dbpass = 'root';
    public $dbname = 'blog';

    function __construct(){
        if (!isset($_SESSION)) {
            session_start();
        }
    }
    
    public function model($model) {
        require_once "models/$model.php";
        return new $model();
    }

    public function view($view, $data = Array()) {
        require_once "views/$view.php";
    } 

    function sql_connect(){
        return mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname, 8443);
    }

}

?>
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

    function smarty(){
        require('class/Smarty.class.php');
        $smarty = new Smarty;
        $smarty->template_dir = 'views';
        $smarty->compile_dir = 'views/';
        $smarty->config_dir = 'demo/configs/';
        $smarty->cache_dir = 'demo/cache/';
        $smarty->error_reporting = "E_ERROR || E_WARNING";
        return $smarty;
    }

    function pdo(){
        $pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "root");
        $pdo->exec("set names utf8");
        return $pdo;
    }

}

?>
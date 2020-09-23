<?php
    require('class/Smarty.class.php');
    $smarty = new Smarty;
    $smarty->template_dir = 'views';
    $smarty->compile_dir = 'views/';
    $smarty->config_dir = 'demo/configs/';
    $smarty->cache_dir = 'demo/cache/';
    $smarty->error_reporting = "E_ERROR || E_WARNING";

    $methodName = isset($url[1]) ? $url[1] : "index";

    // mysqlPDO
    $pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "root");
    $pdo->exec("set names utf8");
?>
<?php
    require('class/Smarty.class.php');
    $smarty = new Smarty;
    $smarty->template_dir = 'views';
    $smarty->compile_dir = 'views/';
    $smarty->config_dir = 'demo/configs/';
    $smarty->cache_dir = 'demo/cache/';
?>
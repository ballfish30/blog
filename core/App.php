<?php

class App
{

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $url = $this->parseUrl();
        $controllerName = "{$url[0]}Controller";
        if (!file_exists("controllers/$controllerName.php"))
            return;
        require_once "controllers/$controllerName.php";
        $controller = new $controllerName;
        $methodName = isset($url[1]) ? $url[1] : "index";
        //smarty
        if (!method_exists($controller, $methodName))
            return;
        unset($url[0]);
        unset($url[1]);
        $params = $url ? array_values($url) : array();
        if ($methodName != 'login' and $methodName != 'register') {
            if (!isset($_SESSION['userId'])) {
                include 'main.php';
                $smarty->assign('message', '請登入帳號');
                return $smarty->display('user/login.php');
            }
        }
        call_user_func_array(array($controller, $methodName), $params);
    }

    public function parseUrl()
    {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/");
            $url = explode("/", $url);
            return $url;
        }
    }
}

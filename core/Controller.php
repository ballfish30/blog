<?php

class Controller {
    public function model($model) {
        require_once "models/$model.php";
        return new $model();
    }

    public function view($view, $data = Array()) {
        session_start();
        if($view != 'User/login' and $view != 'User/register'){
            //smarty
            include 'main.php';
            if(!isset($_SESSION['userId'])){
                $smarty->assign('message','請登入帳號');
                $smarty->display('blog/user/login.php');
            }
        }
        require_once "views/$view.php";
    } 

}

?>
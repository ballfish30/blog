<?php

class Controller {
    public function model($model) {
        require_once "models/$model.php";
        return new $model();
    }

    public function view($view, $data = Array()) {
        session_start();
        if($view != 'User/login' and $view != 'User/register'){
            if(!isset($_SESSION['userId'])){
                $data = ['message'=>'請登入帳號'];
                return require_once "views/user/login.php";
            }
        }
        require_once "views/$view.php";
    } 

    // public function redirect_post($url, array $data, array $headers = null) {
    //     $params = array(
    //         'http' => array(
    //             'method' => 'POST',
    //             'content' => http_build_query($data)
    //         )
    //     );
    //     if (!is_null($headers)) {
    //         $params['http']['header'] = '';
    //         foreach ($headers as $k => $v) {
    //             $params['http']['header'] .= "$k: $v\n";
    //         }
    //     }
    //     $ctx = stream_context_create($params);
    //     $fp = @fopen($url, 'rb', false, $ctx);
    //     echo $fp;
    //     echo @stream_get_contents($fp);
    //     return;
    //     if ($fp) {
    //         echo @stream_get_contents($fp);
    //         die();
    //     } else {
    //         // Error
    //         throw new Exception("Error loading '$url', $php_errormsg");
    //     }
    // }

}

?>
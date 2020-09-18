<?php

class UserController extends Controller
{
    
    function index(){
        $this->view("User/login");
    }

    // 登入
    function login(){
        // require_once 'core/Smarty.class.php';
        // $smarty = new Smarty();
        // var_dump($smarty);
        // $smarty->assign('name','Ned');
        // $smarty->display();
        session_start();
        if($_SERVER['REQUEST_METHOD']==='GET'){
            return $this->view("User/login");
        }
        // POST
        $accountName = $_POST['accountName'];
        $passwd = $_POST['passwd'];
        // 取的資料庫連線
        $link = include 'config.php';
        $sql = <<<mutil
            select * from user where accountName = "$accountName";
        mutil;
        $result = mysqli_query($link, $sql);
        // 取得使用者
        $user = mysqli_fetch_assoc($result);
        // 判斷使用者
        if ($user === Null){
            return $this->view("User/login", ['message'=>"此帳號未註冊"]);
        }
        // 判斷密碼
        elseif(!password_verify($passwd, $user['passwd'])){
            $_SESSION['message'] = '密碼錯誤';
            return $this->view("User/login");
        }
        $_SESSION['message'] = '登入成功';
        $_SESSION['userId'] = $user['id'];
        $_SESSION['userName'] = $user['userName'];
        return header("Location: /blog/blog/index");

    }

    // 登出
    function logout(){
        session_start();
        // 清除session
        session_destroy();
        $_SESSION['message'] = '已登出';
        return header("Location: /blog/user/login");
    }

    // 註冊
    function register(){
        session_start();
        if($_SERVER['REQUEST_METHOD']==='GET'){
            return $this->view("User/register");
        }
        // POST
        $accountName = $_POST['accountName'];
        $passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        // 取的資料庫連線
        $link = include 'config.php';
        $sql = <<<mutil
            select * from user where accountName="$accountName"
        mutil;
        $user = mysqli_fetch_assoc($result);
        // 判斷使用者‘
        if ($user != Null){
            $_SESSION['message'] = '此帳號已註冊';
            return $this->view("User/register", ['message'=>'此帳號已註冊']);
        }
        $sql = <<<mutil
          insert into user(
            accountName, userName, passwd, email
          )
          values(
            "$accountName", "$userName",  "$passwd", "$email"
          )
        mutil;
        if(mysqli_query($link, $sql)){
            $_SESSION['message'] = '註冊成功，請登入';
            return header("Location: /blog/user");
        }else{
            $_SESSION['message'] = '註冊失敗';
            echo $sql;
            return $this->view("User/register", ['message'=>'註冊失敗']);
        }
    }

}
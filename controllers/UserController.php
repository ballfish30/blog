<?php

class UserController extends Controller
{
    
    function index(){
        $this->view("User/login");
    }

    // 登入
    function login(){
        if (!isset($_SESSION)) {
            session_start();
        }
        //smarty
        include 'main.php';
        if($_SERVER['REQUEST_METHOD']==='GET'){
            return $smarty->display('user/login.php');
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
            $smarty->assign('message','無使用者');
            return $smarty->display('user/login.php');
        }
        // 判斷密碼
        elseif(!password_verify($passwd, $user['passwd'])){
            $_SESSION['message'] = '密碼錯誤';
            return $smarty->display('user/login.php');
        }
        $_SESSION['userId'] = $user['id'];
        $_SESSION['userName'] = $user['userName'];
        $smarty->assign('userName',$_SESSION['userName']);
        return header("Location: /blog/blog/index/1");

    }

    // 登出
    function logout(){
        if (!isset($_SESSION)) {
            session_start();
        }
        // 清除session
        session_destroy();
        //smarty
        include 'main.php';
        $smarty->assign('message','已登出');
        $smarty->display('user/login.php');
    }

    // 註冊
    function register(){
        //smarty
        include 'main.php';
        if (!isset($_SESSION)) {
            session_start();
        }
        if($_SERVER['REQUEST_METHOD']==='GET'){
            return $smarty->display('user/register.php');
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
        $result = mysqli_query($link, $sql);
        $user = mysqli_fetch_assoc($result);
        // 判斷使用者‘
        if ($user != Null){
            $smarty->assign('message','此帳號已註冊');
            return $smarty->display('user/register.php');
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
            $smarty->assign('message','註冊成功，請登入');
            return $smarty->display('user/login.php');
        }else{
            $smarty->assign('message','註冊失敗');
            return $smarty->display('user/register.php');
        }
    }

}
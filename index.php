<?php

require_once 'core/App.php';
require_once 'core/Controller.php';

$app = new App();
session_start();
if(isset($_SESSION['message'])){
    echo "<script>alert('$_SESSION[message]')</script>";
    unset($_SESSION['message']);
}
?>
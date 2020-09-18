<?php if($data['message']){
  echo "<div class='alert alert-primary alert-dismissible fade show'>
  <strong>系統訊息!</strong> $data[message]
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
</div>";
}?>
<?php require_once('head.php'); ?>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <span style="font-size: 48px;">
       <i class="far fa-user-circle"></i>
</span>
    </div>

    <!-- Login Form -->
    <form method="post" action="/blog/user/login"> 
      <input type="text" id="login" class="fadeIn second" name="accountName" placeholder="login" required="required">
      <input type="password" id="password" class="fadeIn third" name="passwd" placeholder="password" required="required">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Register -->
    <div id="formFooter">
      <a class="underlineHover" href="/blog/user/register">Register?</a>
    </div>

  </div>
</div>
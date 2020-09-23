{{if $message}}
<div class='alert alert-primary alert-dismissible fade show'>
  <strong>系統訊息!</strong> {{$message}}
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
</div>
{{/if}}
{{include file='views/user/head.php'}}
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
    <form method="post" action="/blog/user/register"> 
      <input type="text" id="login" class="fadeIn second" name="accountName" placeholder="accountName" required="required">
      <input type="password" id="password" class="fadeIn third" name="passwd" placeholder="password" required="required">
      <input type="text" name="userName" class="fadeIn fourth" placeholder="userName" required="required">
      <input type="text" name="email" class="fadeIn fiveth" placeholder="email" required="required">
      <input type="submit" class="" value="Register">
    </form>

    <!-- Remind Register -->
    <div id="formFooter">
      <a class="underlineHover" href="/blog/user/login">Login?</a>
    </div>

  </div>
</div>
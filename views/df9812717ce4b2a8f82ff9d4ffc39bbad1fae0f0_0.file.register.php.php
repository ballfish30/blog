<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-23 06:48:53
  from '/Applications/MAMP/htdocs/blog/views/user/register.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f6aefd549f5d7_20250489',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df9812717ce4b2a8f82ff9d4ffc39bbad1fae0f0' => 
    array (
      0 => '/Applications/MAMP/htdocs/blog/views/user/register.php',
      1 => 1600842076,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/user/head.php' => 1,
  ),
),false)) {
function content_5f6aefd549f5d7_20250489 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['message']->value) {?>
<div class='alert alert-primary alert-dismissible fade show'>
  <strong>系統訊息!</strong> <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

  <button type='button' class='close' data-dismiss='alert'>&times;</button>
</div>
<?php }
$_smarty_tpl->_subTemplateRender('file:views/user/head.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
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
</div><?php }
}

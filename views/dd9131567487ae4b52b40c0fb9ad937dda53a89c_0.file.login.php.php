<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-23 06:08:03
  from '/Applications/MAMP/htdocs/blog/views/user/login.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f6ae6433a6359_47215348',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dd9131567487ae4b52b40c0fb9ad937dda53a89c' => 
    array (
      0 => '/Applications/MAMP/htdocs/blog/views/user/login.php',
      1 => 1600825001,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/user/head.php' => 1,
  ),
),false)) {
function content_5f6ae6433a6359_47215348 (Smarty_Internal_Template $_smarty_tpl) {
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
</div><?php }
}

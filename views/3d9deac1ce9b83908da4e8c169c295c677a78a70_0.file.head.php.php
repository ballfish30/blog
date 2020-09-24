<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-24 06:37:35
  from '/Applications/MAMP/htdocs/blog/views/blog/head.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f6c3eaf1f5266_05440221',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d9deac1ce9b83908da4e8c169c295c677a78a70' => 
    array (
      0 => '/Applications/MAMP/htdocs/blog/views/blog/head.php',
      1 => 1600929442,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f6c3eaf1f5266_05440221 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php echo '<script'; ?>
 src='/blog/js/jquery.min.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://kit.fontawesome.com/615cd4ec63.js" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <link rel="stylesheet" href="/blog/css/article.css">
    <link rel="stylesheet" href="/blog/css/form.css">
    <link rel="stylesheet" href="/blog/css/main.css">
    <link rel="stylesheet" href="/blog/css/table.css">
    <link rel="stylesheet" href="/blog/css/button.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"><?php echo '</script'; ?>
>
</head>
<body>
<?php if ($_smarty_tpl->tpl_vars['message']->value) {?>
<div class='alert alert-primary alert-dismissible fade show'>
  <strong>系統訊息!</strong> <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

  <button type='button' class='close' data-dismiss='alert'>&times;</button>
</div>
<?php }?>
暱稱：<?php echo $_smarty_tpl->tpl_vars['userName']->value;?>

    <a class="btn btn-submit floatRight" href="/blog/user/logout">登出</a>  
    <a class="btn btn-submit floatRight" href="/blog/blog/index/<?php echo $_smarty_tpl->tpl_vars['pag']->value;?>
">首頁</a>  
<hr>
    
<?php }
}

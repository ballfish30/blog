<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-23 09:38:21
  from '/Applications/MAMP/htdocs/blog/views/blog/articleCreate.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f6b178d757fc9_41167879',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f74f38de78d962dea863e858b2dbb9a5f02365e5' => 
    array (
      0 => '/Applications/MAMP/htdocs/blog/views/blog/articleCreate.php',
      1 => 1600853525,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/blog/head.php' => 1,
    'file:views/blog/footer.php' => 1,
  ),
),false)) {
function content_5f6b178d757fc9_41167879 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['message']->value) {?>
<div class='alert alert-primary alert-dismissible fade show'>
  <strong>系統訊息!</strong> <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

  <button type='button' class='close' data-dismiss='alert'>&times;</button>
</div>
<?php }
$_smarty_tpl->_subTemplateRender('file:views/blog/head.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form method="post" action="/blog/blog/articleCreate">
  標題：<input type="text" name="title" required="required" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
"><br><br>
  內容：<textarea rows="5" cols="50" name="content" required="required"><?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</textarea><br><br>
  <input type="submit" value="建立文章">
</form>
<?php $_smarty_tpl->_subTemplateRender('file:views/blog/footer.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-24 07:34:50
  from '/Applications/MAMP/htdocs/blog/views/blog/articleCreate.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f6c4c1aae4423_45603437',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f74f38de78d962dea863e858b2dbb9a5f02365e5' => 
    array (
      0 => '/Applications/MAMP/htdocs/blog/views/blog/articleCreate.php',
      1 => 1600932887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/blog/head.php' => 1,
    'file:views/blog/footer.php' => 1,
  ),
),false)) {
function content_5f6c4c1aae4423_45603437 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:views/blog/head.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form method="post" action="/blog/blog/articleCreate">
  標題：<input type="text" name="title" required="required" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
"><br><br>
  內容：<textarea rows="5" cols="50" name="content" required="required"><?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</textarea><br><br>
  <input type="submit" value="建立文章">
  <p><a class="btn btn-submit floatLeft" href="/blog/blog/index/<?php echo $_smarty_tpl->tpl_vars['pag']->value;?>
">返回</a></p>
</form>
<?php $_smarty_tpl->_subTemplateRender('file:views/blog/footer.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

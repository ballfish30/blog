<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-25 01:32:37
  from '/Applications/MAMP/htdocs/blog/views/blog/articleUpdate.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f6d48b511e3f3_73733183',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3149595880c9f74994903ea0421f18632169d53a' => 
    array (
      0 => '/Applications/MAMP/htdocs/blog/views/blog/articleUpdate.php',
      1 => 1600997554,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/blog/head.php' => 1,
    'file:views/blog/footer.php' => 1,
  ),
),false)) {
function content_5f6d48b511e3f3_73733183 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:views/blog/head.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form method="post" action="/blog/blog/articleUpdate/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
標題：<input type="text" name="title" required="required" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
"><br><br>
內容：<textarea rows="5" cols="50" name="content" required="required"><?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</textarea><br><br>
<p><input type="submit" value="修改文章"></p>
<p><a class="btn btn-submit floatLeft" href="/blog/blog/articleRead/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">返回</a></p>
</form>
<?php $_smarty_tpl->_subTemplateRender('file:views/blog/footer.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

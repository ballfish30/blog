<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-23 06:59:41
  from '/Applications/MAMP/htdocs/blog/views/blog/articles.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f6af25da47c31_64961021',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '52e40243c16da1150ff8fbe243c18775ce7a53c7' => 
    array (
      0 => '/Applications/MAMP/htdocs/blog/views/blog/articles.php',
      1 => 1600844364,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/blog/head.php' => 1,
    'file:views/blog/footer.php' => 1,
  ),
),false)) {
function content_5f6af25da47c31_64961021 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- <?php if ($_smarty_tpl->tpl_vars['message']->value) {?>
<div class='alert alert-primary alert-dismissible fade show'>
  <strong>系統訊息!</strong> <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

  <button type='button' class='close' data-dismiss='alert'>&times;</button>
</div>
<?php }?> -->
<?php $_smarty_tpl->_subTemplateRender('file:views/blog/head.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<br><a class="btn btn-new" href="/blog/blog/articleCreate">新增文章</a><br><br>
<table width=100%;>
<tr>
    <th>標題</th><th>內容</th><th>作者</th>
</tr>
<main role="main" class="container bootdey.com">
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['articles']->value, 'article', false, NULL, 'foo', array (
));
$_smarty_tpl->tpl_vars['article']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->do_else = false;
?>
    <tr>
        <td><a href="/blog/blog/articleRead/<?php echo $_smarty_tpl->tpl_vars['article']->value['articleId'];?>
"><?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
</a></td>
        <td><pre><?php echo $_smarty_tpl->tpl_vars['article']->value['content'];?>
</pre></td>
        <td><?php echo $_smarty_tpl->tpl_vars['article']->value['userName'];?>
</td>
    </tr>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

</main>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
  </ul>
</nav>
<?php echo '<script'; ?>
>
    $(document).ready(function() {
        $html = ''
        console.log($(".pagination").html("<li>123</li>"));
        for (var i=1; i<=<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
; i++){
            $html += "<li class='page-item'><a class='page-link' href=/blog/blog/index/"+i+">"+i+"</a></li>"
        }
        $(".pagination").html($html);
    });
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender('file:views/blog/footer.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

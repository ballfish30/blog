<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-25 02:09:55
  from '/Applications/MAMP/htdocs/blog/views/blog/articleRead.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f6d5173754a45_52883948',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f3d5b7237410da1f48baf3804b2be55a34917cbe' => 
    array (
      0 => '/Applications/MAMP/htdocs/blog/views/blog/articleRead.php',
      1 => 1600999792,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/blog/head.php' => 1,
    'file:views/blog/footer.php' => 1,
  ),
),false)) {
function content_5f6d5173754a45_52883948 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:views/blog/head.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<p><a class="btn btn-submit floatRight" href="/blog/blog/index/<?php echo $_smarty_tpl->tpl_vars['pag']->value;?>
">返回</a></p>
<p>標題：<?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
</p>
<p>內容：
    <pre><?php echo $_smarty_tpl->tpl_vars['article']->value['content'];?>
</pre>
</p>
<?php if ($_smarty_tpl->tpl_vars['userId']->value == $_smarty_tpl->tpl_vars['article']->value['userId']) {?>
<p><a class="btn btn-submit floatRight" href="/blog/blog/articleUpdate/<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
">修改文章</a></p>
<p><a class="btn btn-submit floatRight articleDelete" href="/blog/blog/articleDelete/<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
">刪除文章</a></p>
<?php }?>
<hr>
<main role='main' class='container bootdey.com'>
    <h1>留言板：</h1>
    <input type="text" id="commentCreate"> <button id="commentSend">送出留言</button>
</main>
<div id="comment"></div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">修改留言</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form>
                    <!-- <div class="form-group">
            <label for="recipient-name" class="control-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div> -->
                    <div class="form-group">
                        <label for="message-text" class="control-label">留言：</label>
                        <textarea class="form-control" id="message-text" required></textarea>
                    </div>
                    <input type="hidden" value="1" id="commentId">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary commentUpdate">修改留言</button>
            </div>
        </div>
    </div>
</div>
<?php echo '<script'; ?>
>
    $(document).ready(function() {
        function reComment() {
            $.ajax({
                    type: "POST",
                    url: "/blog/blog/commentAll/<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
"
                })
                .done(function(data) {
                    $html = "";
                    $data = JSON.parse(data)
                    for (comment of $data) {
                        $html += "<main role='main' class='container bootdey.com'>";
                        $html += "    <div class='d-flex align-items-center p-3 my-3 text-white-50 bg-light rounded box-shadow'>";
                        $html += "    <img class='mr-3' src='https://bootdey.com/img/Content/avatar/avatar1.png' alt='' width='48' height='48'>";
                        $html += "    <div class='lh-100' style='width:100%'>";
                        $html += "      <h6 class='mb-0 text-dark lh-100'>" + comment['userName'] + "</h6>"
                        $html += "      <small class='text-dark'>" + comment['content'] + "</small>"
                        $html += "    </div>";
                        if ("<?php echo $_smarty_tpl->tpl_vars['userName']->value;?>
" == comment['userName']) {
                            $html += "    <div class='lh-100 floatLeft marginRight'><a  data-toggle='modal' data-target='#exampleModal' data-whatever=" + comment['id'] + " data-content=" + comment['content'] + " class='btn btn-submit floatRight text-white'>修改</a></div>"
                            $html += "    <div class='lh-100 floatLeft'><button class='btn btn-submit floatRight commentDelete text-white' value=" + comment['id'] + ">刪除</button></div>"
                        }
                        $html += "    </div>";
                        $html += "</main>"
                    }
                    $("#comment").html($html);
                    
                    $(".commentDelete").on("mousedown", function() {
                        $this = $(this);
                        if (confirm("是否刪除")){
                            $.ajax({
                                type: "GET",
                                url: "/blog/blog/commentDelete/" + $this.val(),
                            })
                            .done(function(data) {
                                if (data) {
                                    reComment();
                                } else {
                                    alert('修改失敗')
                                }
                            });
                        }else{
                            return false;
                        }
                        
                    });
                })
        }

        $(".articleDelete").on("mousedown", function() {
            $this = $(this);
            if (!confirm("是否刪除")){
                return false;
            }
            window.location = $this.attr('href');
        });

        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('#commentId').val(recipient);
            modal.find('#message-text').val(button.data('content'));
        })

        reComment();
        setInterval(function() {
            reComment();
        }, 4000)
        $("#commentSend").on("mousedown", function() {
            $content = $("#commentCreate").val();
            $.ajax({
                    type: "POST",
                    url: "/blog/blog/commentCreate/<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
",
                    data: {
                        'content': $content
                    }
                })
                .done(function(data) {
                    if (data) {
                        $("#commentCreate").val("");
                        reComment();
                    } else {
                        alert('新增失敗')
                    }
                });
        })

        $(".commentUpdate").on("mousedown", function() {
            $content = $('#exampleModal').find('#message-text').val();
            $id = $('#commentId').val();
            $.ajax({
                    type: "POST",
                    url: "/blog/blog/commentUpdate/" + $id,
                    data: {
                        'content': $content
                    }
                })
                .done(function(data) {
                    console.log(data);
                    if (data) {
                        $('#exampleModal').find('#message-text').val("");
                        $('#exampleModal').modal('hide');
                        reComment();
                    } else {
                        alert('修改失敗')
                    }
                });
        });

    });
<?php echo '</script'; ?>
>

<?php $_smarty_tpl->_subTemplateRender('file:views/blog/footer.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

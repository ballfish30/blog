{{include file='views/blog/head.php'}}
<p>標題：{{$article.title}}</p>
<p>內容：{{$article.content}}</p>
{{if $userId == $article.userId}}
<p><a class="btn btn-submit floatRight" href="/blog/blog/articleUpdate/{{$article.id}}">修改文章</a></p>
<p><a class="btn btn-submit floatRight" href="/blog/blog/articleDelete/{{$article.id}}">刪除文章</a></p>
{{/if}}
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
<script>
$(document).ready(function() {
    function reComment(){
        $.ajax({
            type:"POST",
            url:"/blog/blog/commentAll/{{$article.id}}"
        })
        .done(function(data){
            $html = "";
            $data = JSON.parse(data)
            for(comment of $data){
                $html += "<main role='main' class='container bootdey.com'>";
                $html += "    <div class='d-flex align-items-center p-3 my-3 text-white-50 bg-light rounded box-shadow'>";
                $html += "    <img class='mr-3' src='https://bootdey.com/img/Content/avatar/avatar1.png' alt='' width='48' height='48'>";
                $html += "    <div class='lh-100' style='width:100%'>";
                $html += "      <h6 class='mb-0 text-dark lh-100'>"+comment['userName']+"</h6>"
                $html += "      <small class='text-dark'>"+comment['content']+"</small>"
                $html += "    </div>";
                if ("{{$userName}}" == comment['userName']){
                    $html += "    <div class='lh-100 floatLeft marginRight'><a  data-toggle='modal' data-target='#exampleModal' data-whatever="+comment['id']+" data-content="+comment['content']+" class='btn btn-submit floatRight text-white'>修改</a></div>"
                    $html += "    <div class='lh-100 floatLeft'><button class='btn btn-submit floatRight commentDelete text-white' value="+comment['id']+">刪除</button></div>"
                }
                $html += "    </div>";
                $html += "</main>"
            }
            $("#comment").html($html);
            $(".commentDelete").on("mousedown", function(){
                $this = $(this);
                $.ajax({
                    type:"GET",
                    url:"/blog/blog/commentDelete/"+$this.val(),
                })
                .done(function(data){
                    if(data){
                        reComment();
                    }else{
                        alert('修改失敗')
                    }
                });
                    return false;
            });
        })
    }

    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('#commentId').val(recipient);
        modal.find('#message-text').val(button.data('content'));
    })

    reComment();
    // setInterval(function(){
    //     reComment();
    // },4000)
    $("#commentSend").on("mousedown", function(){
        $content = $("#commentCreate").val();
        $.ajax({
            type:"POST",
            url:"/blog/blog/commentCreate/{{$article.id}}",
            data:{
                'content' : $content
            }
        })
        .done(function(data){
            if(data){
                $("#commentCreate").val("");
                reComment();
            }else{
                alert('新增失敗')
            }
        });
    })

    $(".commentUpdate").on("mousedown", function(){
        $content = $('#exampleModal').find('#message-text').val();
        $id = $('#commentId').val();
        $.ajax({
            type:"POST",
            url:"/blog/blog/commentUpdate/"+$id,
            data:{
                'content' : $content
            }
        })
        .done(function(data){
            if(data){
                $('#exampleModal').find('#message-text').val("");
                $('#exampleModal').modal('hide');
                reComment();
            }else{
                alert('修改失敗')
            }
        });
    });

});
</script>

{{include file='views/blog/footer.php'}}
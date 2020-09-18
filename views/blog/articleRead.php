<?php
    session_start();
    // 取的資料庫連線
    $link = include 'config.php';
    $sql = <<<mutil
        select * from article where id = "$_SESSION[articleId];"
    mutil;
    $result = mysqli_query($link, $sql);
    $article = mysqli_fetch_assoc($result);
?>
<?php require_once('head.php'); ?>
<p>標題：<?php echo $article['title'] ?></p>
<p>內容：<?php echo $article['content'] ?></p>
<hr>
<main role='main' class='container bootdey.com'>
<h1>留言板：</h1>
<input type="text" id="commentCreate"> <button id="commentSend">送出留言</button>
</main>
<div id="comment"></div>

<script>
$(document).ready(function() {
    function reComment(){
        $.ajax({
            type:"POST",
            url:"/blog/blog/commentAll/<?php echo $article['id']?>"
        })
        .done(function(data){
            $html = "";
            $data = JSON.parse(data)
            for(comment of $data){
                $html += "<main role='main' class='container bootdey.com'>";
                $html += "    <div class='d-flex align-items-center p-3 my-3 text-white-50 bg-light rounded box-shadow'>";
                // $html += "    <div class='lh-100 floatRight'><small class='text-dark'><a class='btn btn-submit floatRight' href='/blog/blog/commentDelete/"+comment['id']+"'>刪除</a></small></div>"
                $html += "    <img class='mr-3' src='https://bootdey.com/img/Content/avatar/avatar1.png' alt='' width='48' height='48'>";
                $html += "    <div class='lh-100'>";
                $html += "      <h6 class='mb-0 text-dark lh-100'>"+comment['userName']+"</h6>"
                $html += "      <small class='text-dark'>"+comment['content']+"</small>"
                $html += "    </div>";
                $html += "    </div>";
                $html += "</main>"
            }
            $("#comment").html($html);
            
        })
    }
    reComment();
    setInterval(function(){
        reComment();
    },4000)
    $("#commentSend").on("mousedown", function(){
        $content = $("#commentCreate").val();
        $.ajax({
            type:"POST",
            url:"/blog/blog/commentCreate/<?php echo $article['id']?>",
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
        })
    })
});
</script>

<?php require_once('footer.php'); ?>
{{include file='views/blog/head.php'}}
<br><a class="btn btn-new" href="/blog/blog/articleCreate">新增文章</a><br><br>
<table width=100%;>
    <tr>
        <th>標題</th>
        <th>內容</th>
        <th>作者</th>
    </tr>
    <main role="main" class="container bootdey.com">
        {{foreach from=$articles item=article name=foo}}
        <tr>
            <td><a href="/blog/blog/articleRead/{{$article.articleId}}">{{$article.title}}</a></td>
            <td>
                <pre>{{$article.content}}</pre>
            </td>
            <td>{{$article.userName}}</td>
        </tr>
        {{/foreach}}

    </main>
</table>
<nav aria-label="Page navigation example">
    <ul class="pagination">
    </ul>
</nav>
<script>
    $(document).ready(function() {
        $html = '';
        console.log('{{$pag}}')
        for (var i=1; i<="{{$count}}"; i++){
            if('{{$pag}}' == i){
                $html += "<li class='page-item active'><a class='page-link' href=/blog/blog/index/"+i+">"+i+"</a></li>";
            }else{
                $html += "<li class='page-item'><a class='page-link' href=/blog/blog/index/"+i+">"+i+"</a></li>"
            }
        }
        $(".pagination").html($html);
    });
</script>
{{include file='views/blog/footer.php'}}
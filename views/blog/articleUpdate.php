{{include file='views/blog/head.php'}}
<form method="post" action="/blog/blog/articleUpdate/{{$id}}">
標題：<input type="text" name="title" required="required"><br><br>
內容：<textarea rows="5" cols="50" name="content" required="required"></textarea><br><br>
<p><input type="submit" value="修改文章"></p>
<p><a class="btn btn-submit floatLeft" href="/blog/blog/articleRead/{{$id}}">返回</a></p>
</form>
{{include file='views/blog/footer.php'}}
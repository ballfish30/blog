
{{include file='views/blog/head.php'}}
<form method="post" action="/blog/blog/articleCreate">
  標題：<input type="text" name="title" required="required" value="{{$title}}"><br><br>
  內容：<textarea rows="5" cols="50" name="content" required="required">{{$content}}</textarea><br><br>
  <input type="submit" value="建立文章">
  <p><a class="btn btn-submit floatLeft" href="/blog/blog/index/{{$pag}}">返回</a></p>
</form>
{{include file='views/blog/footer.php'}}
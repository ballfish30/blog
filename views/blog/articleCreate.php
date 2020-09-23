{{if $message}}
<div class='alert alert-primary alert-dismissible fade show'>
  <strong>系統訊息!</strong> {{$message}}
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
</div>
{{/if}}
{{include file='views/blog/head.php'}}
<form method="post" action="/blog/blog/articleCreate">
標題：<input type="text" name="title" required="required" value="{{$title}}"><br><br>
內容：<textarea rows="5" cols="50" name="content" required="required">{{$content}}</textarea><br><br>
<input type="submit" value="建立文章">
</form>
{{include file='views/blog/footer.php'}}
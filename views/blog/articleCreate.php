<?php require_once('head.php'); ?>
<form method="post" action="/blog/blog/articleCreate">
標題：<input type="text" name="title" required="required"><br><br>
內容：<textarea rows="5" cols="50" name="content" required="required"></textarea><br><br>
<input type="submit" value="建立文章">
</form>
<?php require_once('footer.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src='/blog/js/jquery.min.js'></script>
    <script src="https://kit.fontawesome.com/615cd4ec63.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/blog/css/article.css">
    <link rel="stylesheet" href="/blog/css/form.css">
    <link rel="stylesheet" href="/blog/css/main.css">
    <link rel="stylesheet" href="/blog/css/table.css">
    <link rel="stylesheet" href="/blog/css/button.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</head>
<body>
{{if $message}}
<div class='alert alert-primary alert-dismissible fade show'>
  <strong>系統訊息!</strong> {{$message}}
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
</div>
{{/if}}
暱稱：{{$userName}}
    <a class="btn btn-submit floatRight" href="/blog/user/logout">登出</a>  
    <a class="btn btn-submit floatRight" href="/blog/blog/index/1">首頁</a>  
<hr>
    

<?php
    session_start();
?>
<?php require_once('head.php'); ?>
<br><a class="btn btn-new" href="/blog/blog/articleCreate">新增文章</a><br><br>
<table width=100%;>
<tr>
    <th>標題</th><th>內容</th><th>作者</th>
</tr>
<main role="main" class="container bootdey.com">
<?php while ($row = mysqli_fetch_assoc($data['result'])):?>
<tr>
    <td><a href="<?php if($row['userId'] == $_SESSION['userId']){echo "/blog/blog/articleUpdate/$row[articleId]";}else{echo "/blog/blog/articleRead/$row[articleId]";}?>"><?php echo $row['title'] ?></td>
    <td><pre><?php echo "$row[content]" ?></pre></td>
    <td width=10%><?php echo $row['userName'] ?></td>
</tr>
<?php endwhile?>
</main>
</table>

<?php require_once('footer.php'); ?>
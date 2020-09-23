<?php
class BlogController extends Controller
{
    // 文章列表
    function index($pag=1)
    {
        if ($pag <= 1){
            $min = 0;
        }else{
            $min = ($pag-1) * 10;
        }
        if (!isset($_SESSION)) {
            session_start();
        }
        //smarty
        include 'main.php';
        // 取的資料庫連線
        $link = include 'config.php';
        $sql = <<<mutil
             select *, a.id articleId, u.id userId from article as a inner join user as u on a.userId = u.id order by(-a.id) LIMIT $min, 10;
        mutil;
        $result = mysqli_query($link, $sql);
        $articles = array();
        while ($row = $result->fetch_assoc()) {
            array_push($articles, $row);
        }
        $sql = <<<mutil
            select count(*) from article;
        mutil;
        $result = mysqli_query($link, $sql);
        $count = $result->fetch_assoc();
        $count = floor($count['count(*)']/10);
        $smarty->assign('articles',$articles);
        $smarty->assign('count',$count);
        $smarty->assign('userName',$_SESSION['userName']);
        $smarty->display('blog/articles.php');
    }

    // 文章新增
    function articleCreate(){
        if (!isset($_SESSION)) {
            session_start();
        }
        //smarty
        include 'main.php';
        $title = $_POST['title'];
        $content = $_POST['content'];
        $smarty->assign('title',$title);
        $smarty->assign('content',$content);
        if($_SERVER['REQUEST_METHOD']==='GET'){
            $smarty->assign('userName',$_SESSION['userName']);
            return $smarty->display('blog/articleCreate.php');
        }
        // POST
        if ($title === ""){
            $smarty->assign('message','標題錯誤');
            return $smarty->display('blog/articleCreate.php');
        }else if ($content === ""){
            $smarty->assign('message','內容格式錯誤');
            return $smarty->display('blog/articleCreate.php');
        }
        $userId = $_SESSION['userId'];
        $cmd = $pdo->prepare("insert into article(title, content, userId)values(:title, :content, :userId)");
        $cmd->bindValue(":title", htmlspecialchars($title));
        $cmd->bindValue(":content", htmlspecialchars($content));
        $cmd->bindValue(":userId", $userId);
        if($cmd->execute()){
            return header("Location: /blog/blog/index/1");
        }
        $smarty->assign("message", '新增文章失敗');
        return $smarty->display('blog/articleCreate.php');
    }

    // 文章修改
    function articleUpdate($id){
        if (!isset($_SESSION)) {
            session_start();
        }
        //smarty
        include 'main.php';
        $smarty->assign('userName',$_SESSION['userName']);
        $smarty->assign('id',$id);
        if($_SERVER['REQUEST_METHOD']==='GET'){
            return $smarty->display('blog/articleUpdate.php');
        }
        // POST
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        if ($title === ""){
            $smarty->assign('message','標題錯誤');
            return $smarty->display('blog/articleUpdate.php');
        }else if ($content === ""){
            $smarty->assign('message','內容格式錯誤');
            return $smarty->display('blog/articleUpdate.php');
        }
        $userId = $_SESSION['userId'];
        // 取的資料庫連線
        $link = include 'config.php';
        $sql = <<<mutil
            select * from article where id = "$id";
        mutil;
        $result = mysqli_query($link, $sql);
        $article = mysqli_fetch_assoc($result);
        
        if($article['userId'] != $userId){
            return header("Location: /blog/blog/index/1");
        }else{
            $cmd = $pdo->prepare("update article set title = :title, content = :content where id = :id");
            $cmd->bindValue(":title", $title);
            $cmd->bindValue(":content", $content);
            $cmd->bindValue(":id", $id);
            
            $cmd->execute();
            if($cmd->execute()){
                return header("Location: /blog/blog/articleRead/$id");
            }else{
                return header("Location: /blog/blog/articleUpdate/$id");
            }
        }
    }

    // 文章閱讀
    function articleRead($id){
        if (!isset($_SESSION)) {
            session_start();
        }
        //smarty
        include 'main.php';
        $link = include 'config.php';
        $sql = <<<mutil
            select * from article where id = "$id";
        mutil;
        $result = mysqli_query($link, $sql);
        $article = mysqli_fetch_assoc($result);
        $smarty->assign('article',$article);
        $smarty->assign('userId',$_SESSION['userId']);
        $smarty->assign('userName',$_SESSION['userName']);
        $smarty->display('blog/articleRead.php');
    }

    // 文章刪除
    function articleDelete($id){
        // 取的資料庫連線
        $link = include 'config.php';
        $sql = <<<mutil
            delete from article where id = $id;
        mutil;
        if(mysqli_query($link, $sql)){
            return header("Location: /blog/blog/index/1");
        }else{
            return header("Location: /blog/blog/index/1");
        }
    }

    function commentAll($id){
        // 取的資料庫連線
        $link = include 'config.php';
        $comments = array();
        $sql = <<<mutil
            select content, userName, c.id from comment as c inner join user as u where articleId = "$id" and c.userid = u.id order by(-c.id);
        mutil;
        $result = mysqli_query($link, $sql);
        while ($row = $result->fetch_assoc()){
            array_push($comments, $row);
        }
        echo json_encode($comments);
    }

    // 留言新增
    function commentCreate($id){
        if (!isset($_SESSION)) {
            session_start();
        }
        // POST
        $content = $_POST['content'];
        //smarty
        include 'main.php';
        if($content === ''){
            echo false;
            return;
        }
        $userId = $_SESSION['userId'];
        $cmd = $pdo->prepare("insert into comment(content, userId, articleId)values(:content, :userId, :id)");
        $cmd->bindValue(":content", htmlspecialchars($content));
        $cmd->bindValue(":userId", $userId);
        $cmd->bindValue(":id", $id);
        if($cmd->execute()){
            echo true;
        }else{
            echo false;
        }
    }

    // 留言修改
    function commentUpdate($id){
        if (!isset($_SESSION)) {
            session_start();
        }
        //smarty
        include 'main.php';
        if($_SERVER['REQUEST_METHOD']==='GET'){
            return $this->view("blog/commentUpdate");
        }
        // POST
        $content = htmlspecialchars($_POST['content']);
        $userId = $_SESSION['userId'];
        $sql = <<<mutil
            select * from where id = "$id";
        mutil;
        $result = mysqli_query($link, $sql);
        $comment = mysqli_fetch_assoc($result);
        if($comment['userId'] = $userId){
            $cmd = $pdo->prepare("update comment set content = :content where id = :id;");
            $cmd->bindValue(":content", $content);
            $cmd->bindValue(":id", $id);
            if($cmd->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        };
    }

    // 留言刪除
    function commentDelete($id){
        // 取的資料庫連線
        $link = include 'config.php';
        $sql = <<<mutil
            delete from comment where id = $id;
        mutil;
        if(mysqli_query($link, $sql)){
            echo true;
        }else{
            echo false;
        }
    }
}

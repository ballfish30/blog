<?php
class BlogController extends Controller
{
    // 文章列表
    function index($pag = 1)
    {
        // 取的資料庫連線
        $link = $this->sql_connect();
        $sql = <<<mutil
            select count(*) from article;
        mutil;
        $result = mysqli_query($link, $sql);
        $count = $result->fetch_assoc();
        $count = floor($count['count(*)'] / 3);
        if ($pag <= 1 or $pag > $count) {
            $min = 0;
        } else {
            $min = ($pag - 1) * 3;
        }
        // //smarty
        $smarty = $this->smarty();
        $sql = <<<mutil
             select *, a.id articleId, u.id userId from article as a inner join user as u on a.userId = u.id order by(-a.id) LIMIT $min, 3;
        mutil;
        $result = mysqli_query($link, $sql);
        $articles = array();
        while ($row = $result->fetch_assoc()) {
            array_push($articles, $row);
        }
        $_SESSION['pag'] = $pag;
        $smarty->assign('pag', $_SESSION['pag']);
        $smarty->assign('articles', $articles);
        $smarty->assign('count', $count);
        $smarty->assign('userName', $_SESSION['userName']);
        $smarty->display('blog/articles.php');
    }

    // 文章新增
    function articleCreate()
    {
        //smarty
        $smarty = $this->smarty();
        $title = $_POST['title'];
        $content = $_POST['content'];
        $smarty->assign('title', $title);
        $smarty->assign('content', $content);
        $smarty->assign('userName', $_SESSION['userName']);
        $smarty->assign('pag', $_SESSION['pag']);
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return $smarty->display('blog/articleCreate.php');
        }
        // POST
        if ($title === "") {
            $smarty->assign('message', '標題錯誤');
            return $smarty->display('blog/articleCreate.php');
        } else if ($content === "") {
            $smarty->assign('message', '內容格式錯誤');
            return $smarty->display('blog/articleCreate.php');
        }
        $pdo = $this->pdo();
        $userId = $_SESSION['userId'];
        $cmd = $pdo->prepare("insert into article(title, content, userId)values(:title, :content, :userId)");
        $cmd->bindValue(":title", htmlspecialchars($title));
        $cmd->bindValue(":content", htmlspecialchars($content));
        $cmd->bindValue(":userId", $userId);
        if ($cmd->execute()) {
            return header("Location: /blog/blog/index/1");
        }
        $smarty->assign("message", '新增文章失敗');
        return $smarty->display('blog/articleCreate.php');
    }

    // 文章修改
    function articleUpdate($id)
    {
        //smarty
        $smarty = $this->smarty();
        $smarty->assign('userName', $_SESSION['userName']);
        $smarty->assign('id', $id);
        $smarty->assign('pag', $_SESSION['pag']);
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return $smarty->display('blog/articleUpdate.php');
        }
        // POST
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        if ($title === "") {
            $smarty->assign('message', '標題錯誤');
            return $smarty->display('blog/articleUpdate.php');
        } else if ($content === "") {
            $smarty->assign('message', '內容格式錯誤');
            return $smarty->display('blog/articleUpdate.php');
        }
        $userId = $_SESSION['userId'];
        // 取的資料庫連線
        $link = $this->sql_connect();
        $sql = <<<mutil
            select * from article where id = "$id";
        mutil;
        $result = mysqli_query($link, $sql);
        $article = mysqli_fetch_assoc($result);
        $pdo = $this->pdo();
        if ($article['userId'] != $userId) {
            return header("Location: /blog/blog/index/1");
        } else {
            $cmd = $pdo->prepare("update article set title = :title, content = :content where id = :id");
            $cmd->bindValue(":title", $title);
            $cmd->bindValue(":content", $content);
            $cmd->bindValue(":id", $id);

            $cmd->execute();
            if ($cmd->execute()) {
                return header("Location: /blog/blog/articleRead/$id");
            } else {
                return header("Location: /blog/blog/articleUpdate/$id");
            }
        }
    }

    // 文章閱讀
    function articleRead($id)
    {
        //smarty
        $smarty = $this->smarty();
        $link = include 'config.php';
        $sql = <<<mutil
            select * from article where id = "$id";
        mutil;
        $smarty->assign('pag', $_SESSION['pag']);
        $result = mysqli_query($link, $sql);
        $article = mysqli_fetch_assoc($result);
        $smarty->assign('article', $article);
        $smarty->assign('userId', $_SESSION['userId']);
        $smarty->assign('userName', $_SESSION['userName']);
        $smarty->display('blog/articleRead.php');
    }

    // 文章刪除
    function articleDelete($id)
    {
        // 取的資料庫連線
        $link = $this->sql_connect();
        $sql = <<<mutil
            delete from article where id = $id;
        mutil;
        return (mysqli_query($link, $sql))?(header("Location: /blog/blog/index/1")):header("Location: /blog/blog/index/1");
    }

    function commentAll($id)
    {
        // 取的資料庫連線
        $link = $this->sql_connect();
        $comments = array();
        $sql = <<<mutil
            select content, userName, c.id from comment as c inner join user as u where articleId = "$id" and c.userid = u.id order by(-c.id);
        mutil;
        $result = mysqli_query($link, $sql);
        while ($row = $result->fetch_assoc()) {
            array_push($comments, $row);
        }
        echo json_encode($comments);
    }

    // 留言新增
    function commentCreate($id)
    {
        // POST
        $content = $_POST['content'];
        //smarty
        $smarty = $this->smarty();
        if ($content === '') {
            echo false;
            return;
        }
        $userId = $_SESSION['userId'];
        $pdo = $this->pdo();
        $cmd = $pdo->prepare("insert into comment(content, userId, articleId)values(:content, :userId, :id)");
        $cmd->bindValue(":content", htmlspecialchars($content));
        $cmd->bindValue(":userId", $userId);
        $cmd->bindValue(":id", $id);
        echo (($cmd->execute())?(true):(false));
    }

    // 留言修改
    function commentUpdate($id)
    {
        //smarty
        $smarty = $this->smarty();
        // 取的資料庫連線
        $link = $this->sql_connect();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
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
        if ($comment['userId'] = $userId) {
            $pdo = $this->pdo();
            $cmd = $pdo->prepare("update comment set content = :content where id = :id;");
            $cmd->bindValue(":content", $content);
            $cmd->bindValue(":id", $id);
            echo (($cmd->execute())?(true):(false));
        } else {
            echo false;
        };
    }

    // 留言刪除
    function commentDelete($id)
    {
        // 取的資料庫連線
        $link = $this->sql_connect();
        $sql = <<<mutil
            delete from comment where id = $id;
        mutil;
        echo ((mysqli_query($link, $sql))?(true):(false));
    }

    function test(){
        $this->index(1);
    }
}

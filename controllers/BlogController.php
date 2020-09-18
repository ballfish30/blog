<?php

class BlogController extends Controller
{
    // 文章列表
    function index()
    {
        // 取的資料庫連線
        $link = include 'config.php';
        $sql = <<<mutil
             select *, a.id articleId, u.id userId from article as a inner join user as u on a.userId = u.id order by(-a.id);
        mutil;
        $result = mysqli_query($link, $sql);
        return $this->view('blog/articles', ['result'=>$result]);
    }

    // 文章新增
    function articleCreate(){
        session_start();
        
        
        if($_SERVER['REQUEST_METHOD']==='GET'){
            return $this->view("blog/articleCreate");
        }
        // POST
        $title = $_POST['title'];
        $content = $_POST['content'];
        $userId = $_SESSION['userId'];
        $pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "root");
        $pdo->exec("set names utf8");
        $cmd = $pdo->prepare("insert into article(title, content, userId)values(:title, :content, :userId)");
        $cmd->bindValue(":title", $title);
        $cmd->bindValue(":content", $content);
        $cmd->bindValue(":userId", $userId);
        $cmd->execute();
        echo $cmd->fetch;

        // $sql = <<<mutil
        //     insert into article(
        //         title, content, userId
        //     )values(
        //         "$title", "$content", "$userId"
        //     );
        // mutil;
        // // 取的資料庫連線
        // $link = include 'config.php';
        // if(mysqli_query($link, $sql)){
        //     $_SESSION['message'] = '文章新增成功';
        return header("Location: /blog/blog/index");
        // }else{
        //     return $this->view('blog/articleCreate', ['message'=>'文章新增失敗']);
        // }
    }

    // 文章修改
    function articleUpdate($id){
        session_start();
        if($_SERVER['REQUEST_METHOD']==='GET'){
            $_SESSION['articleId'] = $id;
            return $this->view("blog/articleUpdate", ['articleId'=>$id]);
        }
        // POST
        $title = $_POST['title'];
        $content = $_POST['content'];
        $userId = $_SESSION['userId'];
        // 取的資料庫連線
        $link = include 'config.php';
        $sql = <<<mutil
            select * from article where id = "$id";
        mutil;
        $result = mysqli_query($link, $sql);
        $article = mysqli_fetch_assoc($result);
        if($article['userId'] != $userId){
            $_SESSION['message'] = '非此文章擁有者';
            return header("Location: /blog/blog");
        }else{
            $sql = <<<mutil
                update article
                set
                    title = "$title",
                    content = "$content"
                where
                    id = $id
            mutil;
            if(mysqli_query($link, $sql)){
                $_SESSION['message'] = '文章修改成功';
                return header("Location: /blog/blog/articleRead/$id");
            }else{
                $_SESSION['message'] = '文章修改失敗';
                return header("Location: /blog/blog/articleUpdate/$id");
            }
        }
    }

    // 文章閱讀
    function articleRead($id){
        session_start();
        $_SESSION['articleId'] = $id;
        return $this->view('blog/articleRead', ['articleId'=>$id]);
    }

    // 文章刪除
    function articleDelete($id){
        // 取的資料庫連線
        $link = include 'config.php';
        $sql = <<<mutil
            delete from article where id = $id;
        mutil;
        if(mysqli_query($link, $sql)){
            $_SESSION['message'] = '文章刪除成功';
            return header("Location: /blog/blog/index");
        }else{
            return header("Location: /blog/blog/articleRead/$id");
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
        session_start();
        if($_SERVER['REQUEST_METHOD']==='GET'){
            return $this->view("blog/commentCreate");
        }
        // POST
        $content = $_POST['content'];
        $userId = $_SESSION['userId'];
        // 取的資料庫連線
        $link = include 'config.php';
        $sql = <<<mutil
            insert into comment(
                content, userId, articleId
            )values(
                "$content", "$userId", "$id"
            )
        mutil;
        if(mysqli_query($link, $sql)){
            echo TRUE;
        }else{
            echo FALSE;
        }
    }

    // 留言修改
    function commentUpdate($id){
        session_start();
        if($_SERVER['REQUEST_METHOD']==='GET'){
            return $this->view("blog/commentUpdate");
        }
        // POST
        $content = $_POST['content'];
        $userId = $_SESSION['userId'];
        // 取的資料庫連線
        $link = include 'config.php';
        $sql = <<<mutil
            select * from where id = "$id";
        mutil;
        $result = mysqli_query($link, $sql);
        $comment = mysqli_fetch_assoc($result);
        if($comment['userId'] = $userId){
            $sql = <<<mutil
                update comment
                set
                    content = "$content"
                where
                    id = $id;
            mutil;
            if(mysqli_query($link, $sql)){
                return $this->articleRead($id, ["message"=>"留言修改成功"]);
            }else{
                return $this->articleRead($id, ["message"=>"留言修改成功"]);
            }
        }else{
            return $this->articleRead($comment['articleId'], ["message"=>"非此留言擁有者"]);
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
            echo TRUE;
        }else{
            echo FALSE;
        }
    }


    //testMail
    function testMail(){
        // echo ;
        // $to = "a0938471116@gmail.com";
        // $subject = "test";
        // $message = "test";
        // $headers = "Form: 123". "\r\n";
        // mail($to, $subject, $message, $headers);
        // echo 123;
    }

    //test redirect
    function test(){
        // return header("Location: /blog/blog/index", ['hhh'=>'LLL']);
        // $this->redirect_post("Location: /blog/blog/index", ['123'=>"123"]);
    }
}

<?php


namespace App\Post;


use App\Core\AbstractRepository;
use PDO;

class CommentsRepository extends AbstractRepository
{

    function getTableName(){
        return "comments";
    }
    function getModelName(){
        return "App\\Post\\CommentModel";
    }

    public function allByPost($id){
        $table = $this->getTableName();
        $model = $this->getModelName();

        $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE post_id = :id");
        $stmt->execute(['id'=>$id]);
        $comments = $stmt->fetchAll(PDO::FETCH_CLASS, $model);

        return  $stmt = $comments;

    }


    public function  insertForPost($postId, $content){
        $table = $this->getTableName();
        $stmt = $this->pdo->prepare("INSERT INTO `$table` ( `comment`, `post_id`)
                                           VALUES (:content, :postId)");

        $stmt->execute([
            'content' => $content,
            'postId' => $postId
        ]);
    }
}
<?php

namespace App\Post;

use App\Core\AbstractController;

class PostsController extends AbstractController
{

  public function __construct(PostsRepository $postsRepository, CommentsRepository $commentsRepository)
  {
      $this->postsRepository = $postsRepository;
      $this->comentsRepository = $commentsRepository;
  }

  public function index()
  {
      $posts = $this->postsRepository->all();

      $this->render("post/index", [
        'posts' => $posts
      ]);
  }

  public function show()
  {
      $id = $_GET['id'];
      echo "<br/>";
      echo "<br/>";
      echo "<br/>";
      echo "<br/>";
      if (isset($_POST["content"])){
          $content = $_POST['content'];
          $this->comentsRepository->insertForPost($id,$content);

      }
//      var_dump($_POST);

      $post = $this->postsRepository->find($id);
      $comments = $this->comentsRepository->allByPost($id);


      $this->render("post/show", [
        'post' => $post,
        'comments'=>$comments
      ]);
  }
}

 ?>

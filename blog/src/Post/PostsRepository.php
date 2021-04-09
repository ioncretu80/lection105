<?php
namespace App\Post;

use App\Core\AbstractRepository;
use PDO;

class PostsRepository extends AbstractRepository
{
  function getTableName(){
    return "posts";
  }
  function getModelName(){
    return "App\\Post\\PostModel";
  }
}

?>

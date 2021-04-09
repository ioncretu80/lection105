<?php

namespace App\Core;





use App\Post\CommentsRepository;
use App\Post\PostsRepository;

use App\Post\CommentsController;
use App\Post\PostsController;
use PDO;

use PDOException;

class Container
{

  private $receipts = [];
  private $instances = [];

  public function __construct()
  {
    $this->receipts = [

        'commentsRepository' => function() {
          return new CommentsRepository(
              $this->make('pdo')
          );
        },

      'postsController' => function() {
        return new PostsController(
          $this->make('postsRepository'),
          $this->make('commentsRepository')
        );
      },
      'postsRepository' => function() {
        return new PostsRepository(
          $this->make("pdo")
        );
      },
      'pdo' => function() {

        try {
          $pdo = new PDO(
              'mysql:host=vmdev.swp-hapag-lloyd.de;dbname=cretu;charset=utf8',
              'cretu',
              'cretU1'
          );

        }catch (PDOException $ex){

         echo"Datenbak fehlerconnection";
          die();
        }


        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
      }
    ];
  }

  public function make($name)
  {
    if (!empty($this->instances[$name]))
    {
      return $this->instances[$name];
    }

    if (isset($this->receipts[$name])) {
      $this->instances[$name] = $this->receipts[$name]();
    }

    return $this->instances[$name];
  }

}
 ?>

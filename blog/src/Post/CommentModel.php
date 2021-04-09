<?php
namespace App\Post;

use App\Core\AbstractModel;

class CommentModel extends AbstractModel
{
    public $id;
    public $comment;
    public $post_id;


}